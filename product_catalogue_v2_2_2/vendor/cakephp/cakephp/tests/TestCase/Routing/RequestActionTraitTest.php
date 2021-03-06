<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         3.0.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
namespace Cake\Test\TestCase\Routing;

use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Http\ServerRequest;
use Cake\Http\Session;
use Cake\Routing\DispatcherFactory;
use Cake\Routing\Router;
use Cake\TestSuite\TestCase;
use Cake\Utility\Security;

/**
 * @group deprecated
 */
class RequestActionTraitTest extends TestCase
{
    /**
     * fixtures
     *
     * @var string
     */
    public $fixtures = ['core.Comments', 'core.Posts', 'core.TestPluginComments'];

    /**
     * Setup
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        static::setAppNamespace();
        Security::setSalt('not-the-default');
        DispatcherFactory::clear();
        DispatcherFactory::add('Routing');
        DispatcherFactory::add('ControllerFactory');
        $this->object = $this->getObjectForTrait('Cake\Routing\RequestActionTrait');
        Router::connect('/request_action/:action/*', ['controller' => 'RequestAction']);
        Router::connect('/tests_apps/:action/*', ['controller' => 'TestsApps']);

        $this->errorLevel = error_reporting();
        error_reporting(E_ALL ^ E_USER_DEPRECATED);
    }

    /**
     * teardown
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
        DispatcherFactory::clear();
        Router::reload();
        $this->clearPlugins();

        error_reporting($this->errorLevel);
    }

    /**
     * testRequestAction method
     *
     * @return void
     */
    public function testRequestAction()
    {
        $this->assertNull(Router::getRequest(), 'request stack should be empty.');

        $result = $this->object->requestAction('');
        $this->assertFalse($result);
        $this->assertNull(Router::getRequest(), 'requests were not popped off the stack, this will break url generation');

        $result = $this->object->requestAction('/request_action/test_request_action');
        $expected = 'This is a test';
        $this->assertEquals($expected, $result);
        $this->assertNull(Router::getRequest(), 'requests were not popped off the stack, this will break url generation');

        $result = $this->object->requestAction(Configure::read('App.fullBaseUrl') . '/request_action/test_request_action');
        $expected = 'This is a test';
        $this->assertEquals($expected, $result);
        $this->assertNull(Router::getRequest(), 'requests were not popped off the stack, this will break url generation');

        $result = $this->object->requestAction('/request_action/another_ra_test/2/5');
        $expected = 7;
        $this->assertEquals($expected, $result);
        $this->assertNull(Router::getRequest(), 'requests were not popped off the stack, this will break url generation');

        $result = $this->object->requestAction('/tests_apps/index', ['return']);
        $expected = 'This is the TestsAppsController index view ';
        $this->assertEquals($expected, $result);
        $this->assertNull(Router::getRequest(), 'requests were not popped off the stack, this will break url generation');

        $result = $this->object->requestAction('/tests_apps/some_method');
        $expected = 5;
        $this->assertEquals($expected, $result);
        $this->assertNull(Router::getRequest(), 'requests were not popped off the stack, this will break url generation');

        $result = $this->object->requestAction('/request_action/paginate_request_action');
        $this->assertNull($result);
        $this->assertNull(Router::getRequest(), 'requests were not popped off the stack, this will break url generation');

        $result = $this->object->requestAction('/request_action/normal_request_action');
        $expected = 'Hello World';
        $this->assertEquals($expected, $result);

        $this->assertNull(Router::getRequest(), 'requests were not popped off the stack, this will break url generation');
    }

    /**
     * test requestAction() and plugins.
     *
     * @return void
     */
    public function testRequestActionPlugins()
    {
        $this->loadPlugins(['TestPlugin']);
        Router::reload();
        Router::connect('/test_plugin/tests/:action/*', ['controller' => 'Tests', 'plugin' => 'TestPlugin']);

        $result = $this->object->requestAction('/test_plugin/tests/index', ['return']);
        $expected = 'test plugin index';
        $this->assertEquals($expected, $result);

        $result = $this->object->requestAction('/test_plugin/tests/index/some_param', ['return']);
        $expected = 'test plugin index';
        $this->assertEquals($expected, $result);

        $result = $this->object->requestAction(
            ['controller' => 'Tests', 'action' => 'index', 'plugin' => 'TestPlugin'],
            ['return']
        );
        $expected = 'test plugin index';
        $this->assertEquals($expected, $result);

        $result = $this->object->requestAction('/test_plugin/tests/some_method');
        $expected = 25;
        $this->assertEquals($expected, $result);

        $result = $this->object->requestAction(
            ['controller' => 'Tests', 'action' => 'some_method', 'plugin' => 'TestPlugin']
        );
        $expected = 25;
        $this->assertEquals($expected, $result);
    }

    /**
     * test requestAction() with arrays.
     *
     * @return void
     */
    public function testRequestActionArray()
    {
        $this->loadPlugins(['TestPlugin']);

        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'test_request_action']
        );
        $expected = 'This is a test';
        $this->assertEquals($expected, $result);

        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'another_ra_test'],
            ['pass' => ['5', '7']]
        );
        $expected = 12;
        $this->assertEquals($expected, $result);

        $result = $this->object->requestAction(
            ['controller' => 'TestsApps', 'action' => 'index'],
            ['return']
        );
        $expected = 'This is the TestsAppsController index view ';
        $this->assertEquals($expected, $result);

        $result = $this->object->requestAction(['controller' => 'TestsApps', 'action' => 'some_method']);
        $expected = 5;
        $this->assertEquals($expected, $result);

        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'normal_request_action']
        );
        $expected = 'Hello World';
        $this->assertEquals($expected, $result);

        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'paginate_request_action']
        );
        $this->assertNull($result);

        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'paginate_request_action'],
            ['pass' => [5]]
        );
        $this->assertNull($result);
    }

    /**
     * Test that the required parameter names are seeded by requestAction.
     *
     * @return void
     */
    public function testRequestActionArraySetParamNames()
    {
        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'params_pass']
        );
        $result = json_decode($result, true);
        $this->assertArrayHasKey('action', $result['params']);
        $this->assertArrayHasKey('controller', $result['params']);
        $this->assertArrayHasKey('plugin', $result['params']);
    }

    /**
     * Test that requestAction() does not forward the 0 => return value.
     *
     * @return void
     */
    public function testRequestActionRemoveReturnParam()
    {
        $result = $this->object->requestAction(
            '/request_action/param_check',
            ['return']
        );
        $this->assertEquals('', $result, 'Return key was found');
    }

    /**
     * Test that requestAction() is populating $this->params properly
     *
     * @return void
     */
    public function testRequestActionParamParseAndPass()
    {
        $result = $this->object->requestAction('/request_action/params_pass');
        $result = json_decode($result, true);
        $this->assertEquals('/request_action/params_pass', $result['url']);
        $this->assertEquals('RequestAction', $result['params']['controller']);
        $this->assertEquals('params_pass', $result['params']['action']);
        $this->assertNull($result['params']['plugin']);
    }

    /**
     * Test that requestAction() is populates the base and webroot properties properly
     *
     * @return void
     */
    public function testRequestActionBaseAndWebroot()
    {
        $request = new ServerRequest([
            'base' => '/subdir',
            'webroot' => '/subdir/',
        ]);
        Router::setRequestInfo($request);
        $result = $this->object->requestAction('/request_action/params_pass');
        $result = json_decode($result, true);
        $this->assertEquals($request->base, $result['base']);
        $this->assertEquals($request->webroot, $result['webroot']);
    }

    /**
     * test that requestAction does not fish data out of the POST
     * superglobal.
     *
     * @return void
     */
    public function testRequestActionNoPostPassing()
    {
        $_POST = [
            'item' => 'value',
        ];
        $result = $this->object->requestAction(['controller' => 'RequestAction', 'action' => 'post_pass']);
        $result = json_decode($result, true);
        $this->assertEmpty($result);

        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'post_pass'],
            ['post' => $_POST]
        );
        $result = json_decode($result, true);
        $this->assertEquals($_POST, $result);
    }

    /**
     * test that requestAction() can get query data from the query string and
     * query option.
     *
     * @return void
     */
    public function testRequestActionWithQueryString()
    {
        $query = ['page' => 1, 'sort' => 'title'];
        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'query_pass'],
            ['query' => $query]
        );
        $result = json_decode($result, true);
        $this->assertEquals($query, $result);

        $result = $this->object->requestAction([
            'controller' => 'RequestAction',
            'action' => 'query_pass',
            '?' => $query,
        ]);
        $result = json_decode($result, true);
        $this->assertEquals($query, $result);

        $result = $this->object->requestAction(
            '/request_action/query_pass?page=3&sort=body'
        );
        $result = json_decode($result, true);
        $expected = ['page' => 3, 'sort' => 'body'];
        $this->assertEquals($expected, $result);
    }

    /**
     * Test requestAction with post data.
     *
     * @return void
     */
    public function testRequestActionPostWithData()
    {
        $data = [
            'Post' => ['id' => 2],
        ];
        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'post_pass'],
            ['post' => $data]
        );
        $result = json_decode($result, true);
        $this->assertEquals($data, $result);

        $result = $this->object->requestAction(
            '/request_action/post_pass',
            ['post' => $data]
        );
        $result = json_decode($result, true);
        $this->assertEquals($data, $result);
    }

    /**
     * Test that requestAction handles get parameters correctly.
     *
     * @return void
     */
    public function testRequestActionGetParameters()
    {
        $result = $this->object->requestAction(
            '/request_action/params_pass?get=value&limit=5'
        );
        $result = json_decode($result, true);
        $this->assertEquals('value', $result['query']['get']);

        $result = $this->object->requestAction(
            ['controller' => 'RequestAction', 'action' => 'params_pass'],
            ['query' => ['get' => 'value', 'limit' => 5]]
        );
        $result = json_decode($result, true);
        $this->assertEquals('value', $result['query']['get']);
    }

    /**
     * Test that requestAction handles cookies correctly.
     *
     * @return void
     */
    public function testRequestActionCookies()
    {
        $cookies = [
            'foo' => 'bar',
        ];
        $result = $this->object->requestAction(
            '/request_action/cookie_pass',
            ['cookies' => $cookies]
        );
        $result = json_decode($result, true);
        $this->assertEquals($cookies, $result);
    }

    /**
     * Test that environment overrides can be set.
     *
     * @return void
     */
    public function testRequestActionEnvironment()
    {
        $result = $this->object->requestAction('/request_action/params_pass');
        $result = json_decode($result, true);
        $this->assertEquals('', $result['contentType'], 'Original content type not found.');

        $result = $this->object->requestAction(
            '/request_action/params_pass',
            ['environment' => ['CONTENT_TYPE' => 'application/json']]
        );
        $result = json_decode($result, true);
        $this->assertEquals('application/json', $result['contentType']);
    }

    /**
     * Tests that it is possible to transmit the session for the request
     *
     * @return void
     */
    public function testRequestActionSession()
    {
        $result = $this->object->requestAction('/request_action/session_test');
        $this->assertNull($result);

        $session = $this->getMockBuilder(Session::class)->getMock();
        $session->expects($this->once())
            ->method('read')
            ->with('foo')
            ->will($this->returnValue('bar'));
        $result = $this->object->requestAction(
            '/request_action/session_test',
            ['session' => $session]
        );
        $this->assertEquals('bar', $result);
    }

    /**
     * requestAction relies on both the RoutingFilter and ControllerFactory
     * filters being connected. Ensure it can correct the missing state.
     *
     * @return void
     */
    public function testRequestActionAddsRequiredFilters()
    {
        DispatcherFactory::clear();

        $result = $this->object->requestAction('/request_action/test_request_action');
        $expected = 'This is a test';
        $this->assertEquals($expected, $result);
    }
}
