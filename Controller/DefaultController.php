<?php

namespace Yamiko\CacheAdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Yamiko\CacheAdministrationBundle\CacheManager;

/**
 * Default controller.
 *
 * Class DefaultController
 */
class DefaultController extends Controller
{

    /** @var CacheManager */
    private $cacheManager;

    /** @var Session */
    private $session;

    /**
     * @param CacheManager $cacheManager
     * @param Session      $session
     */
    public function __construct(CacheManager $cacheManager, Session $session)
    {
        $this->cacheManager = $cacheManager;
        $this->session = $session;
    }

    /**
     * clears annotations cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function annotationsAction(Request $request)
    {
        $this->cacheManager->clearAnnotations();

        return $this->flashResponse($request, 'annotations', true);
    }

    /**
     * clear assetic cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function asseticAction(Request $request)
    {
        $this->cacheManager->clearAssetic();

        return $this->flashResponse($request, 'assetic', true);
    }

    /**
     * clear doctrine cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function doctrineAction(Request $request)
    {
        $this->cacheManager->clearDoctrine();

        return $this->flashResponse($request, 'doctrine', true);
    }

    /**
     * clear translations cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function translationsAction(Request $request)
    {
        $this->cacheManager->clearTranslations();

        return $this->flashResponse($request, 'translations', true);
    }

    /**
     * clear profiles cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function profilesAction(Request $request)
    {
        $this->cacheManager->clearProfiles();

        return $this->flashResponse($request, 'profilers', true);
    }

    /**
     * clear container cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function containerAction(Request $request)
    {
        $this->cacheManager->clearContainer();

        return $this->flashResponse($request, 'container', true);
    }

    /**
     * clear routing cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function routingAction(Request $request)
    {
        $this->cacheManager->clearAnnotations();

        return $this->flashResponse($request, 'annotations', true);
    }

    /**
     * clear class map cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function classesAction(Request $request)
    {
        $this->cacheManager->clearClasses();

        return $this->flashResponse($request, 'classes', true);
    }

    /**
     * clear templates cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function templatesAction(Request $request)
    {
        $this->cacheManager->clearTemplates();

        return $this->flashResponse($request, 'templates', true);
    }

    /**
     * clear all caches
     * @param Request $request
     * @return RedirectResponse
     */
    public function allAction(Request $request)
    {
        $this->cacheManager->clearAll();

        return $this->flashResponse($request, 'all', true);
    }

    /**
     * generates a flash message and redirects the user to the previous page or the home page
     * @param Request $request
     * @param string $cacheName
     * @param bool|true $success
     * @return RedirectResponse
     */
    protected function flashResponse(Request $request, $cacheName, $success = true)
    {
        $flashType = $success ? 'success' : 'alert';
        $flashMessage = $success ? sprintf("Successfully removed %s cache(s)", $cacheName) : sprintf(
            "Unable to remove %s cache",
            $cacheName
        );
        $redirect = $request->headers->get('referer') ?: "/";

        $this->session->getFlashBag()->add($flashType, $flashMessage);

        return new RedirectResponse($redirect, 302);
    }
}
