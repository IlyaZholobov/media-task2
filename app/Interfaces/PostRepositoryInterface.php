<?php

    namespace App\Interfaces;

    interface PostRepositoryInterface
    {
        public function getByFilter(array $filter);
        public function count(): int;
    }
