<?php

namespace SME\Laravel\ModelEvents;

trait HasEvents {

	public function newEloquentBuilder($query) {
        return new Builder($query, static::getEventDispatcher(), self::class);
    }
}