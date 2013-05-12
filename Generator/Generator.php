<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\DynamicConnectionBundle\Generator;

use Symfony\Component\DependencyInjection\ContainerInterface;

use SIP\DynamicConnectionBundle\Entity\Bundle;

class Generator
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    /**
     * @param \Symfony\Component\DependencyInjection\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @param array $bundleIds
     */
    public function generate($bundleIds)
    {
        if (is_array($bundleIds)) {
            $qb = $this->getDoctrine()->getEntityManager()->getRepository('SIPDynamicConnectionBundle:Bundle')->createQueryBuilder('b');
            $bundles = $qb->where($qb->expr()->in('b.id', $bundleIds))->getQuery()->getResult();
        } else {
            $bundles = $this->getDoctrine()->getRepository('SIPDynamicConnectionBundle:Bundle')->find($bundleIds);
        }

        $this->generateAppKernel($bundles);
        $this->generateConfig($bundles);
        $this->generateRouting($bundles);
    }

    /**
     * @param SIP\DynamicConnectionBundle\Entity\Bundle[] $bundles
     */
    public function generateAppKernel($bundles = array())
    {
        $appKernelPath = $this->getRootDir() . $this->container->getParameter('sip_dynamic_connection.app_kernel.path');
        $code = "<?php \n\n";

        foreach ($bundles as $bundle) {
            $code .=  $bundle->getAppKernel() . "\n";
        }

        @rename($appKernelPath, $appKernelPath . "~");
        if (!file_exists($appKernelPath)) {
            file_put_contents($appKernelPath, $code);
        }
    }

    /**
     * @param SIP\DynamicConnectionBundle\Entity\Bundle[] $bundles
     */
    public function generateConfig($bundles = array())
    {
        $configPath = $this->getRootDir() . $this->container->getParameter('sip_dynamic_connection.config.path');
        $code = '';

        foreach ($bundles as $bundle) {
            $code .=  $bundle->getConfig() . "\n";
        }

        @rename($configPath, $configPath . "~");
        if (!file_exists($configPath)) {
            file_put_contents($configPath, $code);
        }
    }

    /**
     * @param SIP\DynamicConnectionBundle\Entity\Bundle[] $bundles
     */
    public function generateRouting($bundles = array())
    {
        $routingPath = $this->getRootDir() . $this->container->getParameter('sip_dynamic_connection.routing.path');
        $code = '';

        foreach ($bundles as $bundle) {
            $code .=  $bundle->getRouting() . "\n";
        }

        @rename($routingPath, $routingPath . "~");
        if (!file_exists($routingPath)) {
            file_put_contents($routingPath, $code);
        }
    }

    /**
     * @return mixed
     */
    public function getRootDir()
    {
        return $this->container->get('kernel')->getRootDir();
    }

    /**
     * @return \Doctrine\Bundle\DoctrineBundle\Registry
     */
    public function getDoctrine()
    {
        return $this->container->get('doctrine');
    }
}