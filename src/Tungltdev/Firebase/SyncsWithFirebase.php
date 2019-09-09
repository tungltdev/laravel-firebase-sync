<?php

namespace Tungltdev\Firebase;

use Firebase\FirebaseInterface;
use Firebase\FirebaseLib;

/**
 * Class SyncsWithFirebase
 * @package App\Traits
 */
trait SyncsWithFirebase
{

    /**
     * @var FirebaseInterface|null
     */
    protected $firebaseClient;

    /**
     * Boot the trait and add the model events to synchronize with firebase
     */
    public static function bootSyncsWithFirebase()
    {
        static::created(function ($model) {
            $model->saveToFirebase('set');
        });
        static::updated(function ($model) {
            $model->saveToFirebase('update');
        });
        static::deleted(function ($model) {
            $model->saveToFirebase('delete');
        });
    }

    /**
     * @param FirebaseInterface|null $firebaseClient
     */
    public function setFirebaseClient($firebaseClient)
    {
        $this->firebaseClient = $firebaseClient;
    }

    /**
     * @param $mode
     */
    protected function saveToFirebase($mode)
    {
        if (is_null($this->firebaseClient)) {
            $this->firebaseClient = new FirebaseLib(config('services.firebase.database_url'), config('services.firebase.secret'));
        }
        $path = $this->getTable() . '/' . $this->getKey();

        $fresh = $this->fresh();

        if(!in_array('created',$this->getWithoutSyncsWithFirebase()) && $mode === 'set' && $fresh){
            $this->firebaseClient->set($path, $fresh->toArray());
        }elseif(!in_array('updated',$this->getWithoutSyncsWithFirebase()) && $mode === 'update' && $fresh){
            $this->firebaseClient->update($path, $fresh->toArray());
        }elseif(!in_array('deleted',$this->getWithoutSyncsWithFirebase()) && $mode === 'delete') {
            $this->firebaseClient->delete($path);
        }
    }
    private function getWithoutSyncsWithFirebase(){
        // các event không kích hoạt synce database
        return $this->withoutSyncsWithFirebase?:[];
    }
}
