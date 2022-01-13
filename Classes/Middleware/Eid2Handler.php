<?php
namespace Dagou\Eid2\Middleware;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use TYPO3\CMS\Core\Http\DispatcherInterface;
use TYPO3\CMS\Core\Http\NullResponse;
use TYPO3\CMS\Core\Http\Response;

class Eid2Handler implements MiddlewareInterface {
    /**
     * @var \TYPO3\CMS\Core\Http\DispatcherInterface
     */
    protected $dispatcher;

    /**
     * @param \TYPO3\CMS\Core\Http\DispatcherInterface $dispatcher
     */
    public function __construct(DispatcherInterface $dispatcher) {
        $this->dispatcher = $dispatcher;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface {
        $eID2 = $request->getParsedBody()['eID2'] ?? $request->getQueryParams()['eID2'] ?? NULL;

        if ($eID2 === NULL) {
            return $handler->handle($request);
        }

        ob_clean();

        $target = $GLOBALS['TYPO3_CONF_VARS']['FE']['eID_include'][$eID2] ?? NULL;
        if (empty($target)) {
            return (new Response())->withStatus(404, 'eID not registered');
        }

        $request = $request->withAttribute('target', $target);
        return $this->dispatcher->dispatch($request) ?? new NullResponse();
    }
}