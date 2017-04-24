<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AppBundle\Controller;

use AppBundle\Entity\Comment;
use AppBundle\Entity\Post;
use AppBundle\Events;
use AppBundle\Form\CommentType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Cache;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\EventDispatcher\GenericEvent;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Controller used to manage blog contents in the public part of the site.
 *
 * @Route("/explorer")
 *
 * @author Michael COULLERET <michael@coulleret.pro>
 */
class ExplorerController extends Controller
{
    /**
     * @Route("/", name="explorer_index")
     * @Cache(smaxage="0")
     */
    public function indexAction()
    {
        $directories = $this->get('app.explorer_finder')->getDirectories();

        return $this->render('explorer/index.html.twig', ['directories' => $directories]);
    }

    /**
     * @Route("/directory", name="explorer_directory")
     * @Cache(smaxage="0")
     *
     * @return Response
     */
    public function directory(Request $request)
    {
        $relativePath = $request->get('path');

        $directory = $this->get('app.explorer_finder')->getDirectory($relativePath);

        return $this->render('explorer/directory.html.twig', ['directory' => $directory]);
    }
}
