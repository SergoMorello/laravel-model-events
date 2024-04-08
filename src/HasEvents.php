<?php

namespace SME\Laravel\Model;

/**
 * Trait allows you to extend the work of life cycle methods
 * 
 * @method void retrieved(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register a retrieved model event with the dispatcher.
 * @method void saving(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register a saving model event with the dispatcher.
 * @method void saved(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register a saved model event with the dispatcher.
 * @method void updating(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register an updating model event with the dispatcher.
 * @method void updated(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register an updated model event with the dispatcher.
 * @method void creating(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register a creating model event with the dispatcher.
 * @method void created(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register a created model event with the dispatcher.
 * @method void replicating(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register a replicating model event with the dispatcher.
 * @method void deleting(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register a deleting model event with the dispatcher.
 * @method void deleted(\Illuminate\Events\QueuedClosure|\Closure|string  $callback) Register a deleted model event with the dispatcher.
 */
trait HasEvents {

	public function newEloquentBuilder($query) {
        return new Builder($query, static::getEventDispatcher(), $this);
    }
}