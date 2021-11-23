<?php

declare(strict_types=1);

namespace App\Infrastructure\Shared;

use App\Application\Shared\Command\CommandHandlerInterface;
use App\Application\Shared\Query\QueryHandlerInterface;
use App\Infrastructure\Shared\DependencyInjection\RemoveBuiltinProvidersAndPersistersPass;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Routing\Loader\Configurator\RoutingConfigurator;

final class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    protected function configureContainer(ContainerConfigurator $container): void
    {
        $container->import('../../../config/{packages}/*.yaml');
        $container->import('../../../config/{packages}/'.$this->environment.'/*.yaml');

        if (is_file(\dirname(__DIR__).'/../../config/services.yaml')) {
            $container->import('../../../config/services.yaml');
            $container->import('../../../config/{services}_'.$this->environment.'.yaml');
        } else {
            $container->import('../../../config/{services}.php');
        }
    }

    protected function configureRoutes(RoutingConfigurator $routes): void
    {
        $routes->import('../../../config/{routes}/'.$this->environment.'/*.yaml');
        $routes->import('../../../config/{routes}/*.yaml');

        if (is_file(\dirname(__DIR__).'/../../config/routes.yaml')) {
            $routes->import('../../../config/routes.yaml');
        } else {
            $routes->import('../../../config/{routes}.php');
        }
    }

    protected function build(ContainerBuilder $container)
    {
        $container->registerForAutoconfiguration(QueryHandlerInterface::class)
            ->addTag('messenger.message_handler', ['bus' => 'query.bus']);

        $container->registerForAutoconfiguration(CommandHandlerInterface::class)
            ->addTag('messenger.message_handler', ['bus' => 'command.bus']);

        $container->addCompilerPass(new RemoveBuiltinProvidersAndPersistersPass());
    }
}
