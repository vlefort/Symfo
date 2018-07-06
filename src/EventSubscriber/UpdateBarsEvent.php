<?php
 
namespace App\EventSubscriber;
use App\Entity\Bars;
use App\Events;
use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use App\Repository\BarsRepository;

class UpdateBarsEvent implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return [
        'prePersist','preUpdate'];
    }

    public function prePersist(LifecycleEventArgs $args)
    {
        $this->update_bar($args);
    }

    public function preUpdate(LifecycleEventArgs $args)
    {
        $this->update_bar($args);
    }

    public function update_bar(LifecycleEventArgs $args){
        $bars = $args->getEntity();

        if($bars instanceof Bars){
            $bars->setUpdateDate(new \DateTime());

          /*  $em = $args->getEntityManager();

            $barsNom = $em->getRepository(Bars::class)->findByNom($bars->getNom());

            if(count($barsNom) > 0){     
                  throw new \Exception();
            }*/
        } 
    }
}
 
?>