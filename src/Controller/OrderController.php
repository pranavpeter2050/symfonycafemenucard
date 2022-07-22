<?php

namespace App\Controller;

use App\Entity\Dish;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="index_orders")
     */
    public function index(OrderRepository $orderRepository): Response
    {
        $orderitems = $orderRepository->findBy([
            'table_number' => 'table1'
        ]);

        return $this->render('order/index.html.twig', [
            'orderitems' => $orderitems,
        ]);
    }
    
    /**
     * @Route("/order/{id}", name="order")
     */
    public function order(Dish $dish): Response
    {
        $order = new Order();
        $order->setTableNumber("table1");
        $order->setName($dish->getName());
        $order->setOrderNumber($dish->getId());
        $order->setPrice($dish->getPrice());
        $order->setStatus("open");

        //entityManager
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        $this->addFlash('order', $order->getName(). ' was added to your order.');

        return $this->redirect($this->generateUrl('menu'));
    }

}
