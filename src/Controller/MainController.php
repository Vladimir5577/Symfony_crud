<?php

namespace App\Controller;

use App\Repository\WorkerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Worker;
use Symfony\Component\HttpFoundation\Request;

use App\Entity\Article;
use App\Entity\Tag;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class MainController extends AbstractController
{
    /**
     * @Route("/main", name="main")
     */
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route("/", name="home")
     */
    public function home(): Response
    {
        $workers = $this->getDoctrine()
            ->getRepository(Worker::class)
            ->findAll();

        // dd($workers);

    	return $this->render('crud/index.html.twig', ['workers' => $workers]);
    }

    /**
     * @Route("/add_worker", name="add_worker", methods="POST")
     */
    public function add_worker(Request $request, ValidatorInterface $validator): Response
    {
        // dd($request->request->get('name'));

        $entityManager = $this->getDoctrine()->getManager();

        $worker = new Worker();
        $worker->setName($request->request->get('name'));
        $worker->setCountry($request->request->get('country'));
        $worker->setDescription($request->request->get('description'));

        // validation
        $errors = $validator->validate($worker);
        if (count($errors) > 0) {
            $errorsString = (string) $errors;
            $this->addFlash('failed','Fill every fields');
            return $this->redirect('/');
//            return new Response($errorsString);
        }

        $entityManager->persist($worker);
        $entityManager->flush();

        $this->addFlash('success', 'Record created successfully');
        return $this->redirect('/');
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $worker = $entityManager->getRepository(Worker::class)->find($id);

        $entityManager->remove($worker);
        $entityManager->flush();

        return $this->redirect('/');
    }

    /**
     * @Route("/edit/{id}", name="edit")
     */
    public function edit($id)
    {
        $entityManager = $this->getDoctrine()->getManager();
        $worker = $entityManager->getRepository(Worker::class)->find($id);

        // dd($worker);

        return $this->render('crud/edit.html.twig', ['worker' => $worker]);
    }

    /**
     * @Route("/update", name="update", methods="POST")
     */
    public function update(Request $request)
    {
        $id = $request->request->get('id');

        $entityManager = $this->getDoctrine()->getManager();
        $worker = $entityManager->getRepository(Worker::class)->find($id);

        // dd($worker);

        $worker->setName($request->request->get('name'));
        $worker->setCountry($request->request->get('country'));
        $worker->setDescription($request->request->get('description'));

        $entityManager->persist($worker);
        $entityManager->flush();

        return $this->redirect('/');
    }

    /**
     * @Route("/test", name="test")
     */
    public function test()
    {
//        $entityManager = $this->getDoctrine()->getManager();
//
//        /** @var Article[] $articles */
//        $articles = $this->getDoctrine()
//            ->getRepository(Article::class)
//            ->findAll();
//
//        $tags = $this->getDoctrine()
//            ->getRepository(Tag::class)
//            ->findAll();
//
//        $i = 0;
//        foreach ($articles as $article) {
//            $article->addTag($tags[$i]);
//            $article->addTag($tags[$i + 2]);
//            $i++;
//            $entityManager->persist($article);
//        }
//
//        $entityManager->flush();

        /** @var Article $article */
        $article = $this->getDoctrine()
        ->getRepository(Article::class)
        ->find(7);

        /** @var Tag $tag */
        $tag = $this->getDoctrine()
            ->getRepository(Tag::class)
            ->find(30);

        dd($tag->getArticles()->toArray());

        dd('Gook');
    }

    public function bla_test()
    {
        $entityManager = $this->getDoctrine()->getManager();

        $article = new Article();
        $article->setTitle('A good article');
        $article->setDescription('Blab bla bla');


        $entityManager->persist($article);
        $entityManager->flush();
        dd('Working');
    }

}
