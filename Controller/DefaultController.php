<?php

namespace Yamiko\CacheAdministrationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Translation\TranslatorInterface;
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

    /** @var TranslatorInterface */
    private $trans;

    /**
     * @param CacheManager        $cacheManager
     * @param Session             $session
     * @param TranslatorInterface $trans
     */
    public function __construct(CacheManager $cacheManager, Session $session, TranslatorInterface $trans)
    {
        $this->cacheManager = $cacheManager;
        $this->session = $session;
        $this->trans = $trans;
    }

    /**
     * clears annotations cache
     * @param Request $request
     * @return RedirectResponse
     */
    public function annotationsAction(Request $request)
    {
        $this->cacheManager->clearAnnotations();

        return $this->flashResponse($request, 'annotation', true);
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

        return $this->flashResponse($request, 'profiler', true);
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

        return $this->flashResponse($request, 'template', true);
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
     * @param Request   $request
     * @param string    $cacheName
     * @param bool|true $success
     * @return RedirectResponse
     */
    protected function flashResponse(Request $request, $cacheName, $success = true)
    {
        $flashType = $success ? $this->trans->trans('success') : $this->trans->trans('alert');
        $transCacheName = $this->trans->trans($cacheName);

        if ($success) {
            $flashMessage = sprintf($this->trans->trans("Successfully removed %s cache(s)"), $transCacheName);
        } else {
            $flashMessage = sprintf($this->trans->trans("Unable to remove %s cache"), $transCacheName);
        }

        $this->session->getFlashBag()->add($flashType, $flashMessage);
        $redirect = $request->headers->get('referer') ?: "/";

        return new RedirectResponse($redirect, 302);
    }
}
