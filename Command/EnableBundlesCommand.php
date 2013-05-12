<?php
/*
 * (c) Suhinin Ilja <iljasuhinin@gmail.com>
 */
namespace SIP\DynamicConnectionBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Process\Process;

class EnableBundlesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this->setName('sip_dynamic_connection:enableBundles')
            ->setDescription('Enable bundles')
            ->addArgument('ids', InputArgument::REQUIRED, 'Indexes of bundles');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     * @return int|null|void
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $ids = explode(',', $input->getArgument('ids'));

        $output->writeln("Start genetation");
        $this->getGenerator()->generate($ids);

        $process = new Process('php app/console cache:clear');
        $process->run(function ($type, $buffer) {
            if (Process::ERR === $type) {
                echo 'ERR > '.$buffer;
            } else {
                echo 'OUT > '.$buffer;
            }
        });

        $appKernelPath = $this->getGenerator()->getRootDir() .
                         $this->getContainer()->getParameter('sip_dynamic_connection.app_kernel.path');

        $configPath =    $this->getGenerator()->getRootDir() .
                         $this->getContainer()->getParameter('sip_dynamic_connection.config.path');

        $routingPath =   $this->getGenerator()->getRootDir() .
                         $this->getContainer()->getParameter('sip_dynamic_connection.routing.path');

        if (!$process->isSuccessful()) {
            $output->writeln("Wrong settings! Back!");

            @rename($appKernelPath . "~", $appKernelPath);
            @rename($configPath . "~", $configPath);
            @rename($routingPath . "~", $routingPath);
        } else {
            @unlink($appKernelPath . "~");
            @unlink($configPath . "~");
            @unlink($routingPath . "~");
        }

        $output->writeln("Generate bundles: {$input->getArgument('ids')}");
    }

    /**
     * @return \SIP\DynamicConnectionBundle\Generator\Generator
     */
    public function getGenerator()
    {
        return $this->getContainer()->get('sip_dynamic_connection.generator');
    }
}