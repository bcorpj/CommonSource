<?php

namespace App\Custom\FakeFill\Filler;

use Faker\Factory;
use Faker\Generator;

abstract class Creator
{
    protected string $lang = 'en-EN';
    protected int $create_count = 10;
    protected Generator $faker;
    protected string $class;
    protected int $created = 0;
    protected bool $is_dynamic = true;

    public function __construct ()
    {
        $this->faker = Factory::create($this->lang);
        $this->config();
        $this->create_count = !$this->is_dynamic ? 1 : $this->create_count;
        $this->start();
        $this->log();
    }

    private function start ()
    {
        for ($this->created = 0; $this->created < $this->create_count; $this->created++)
        {
            $this->create(new $this->class, $this->faker);
        }
    }

    protected function set_lang (string $lang)
    {
        $this->lang = $lang;
        $this->faker = Factory::create($this->lang);
    }

    protected function set_model (string $class)
    {
        $this->class = $class;
    }

    private function log ()
    {
        print "------------FakeFill------------\n";
        print "Created $this->created records in table $this->class \n";
        print "-------------------------------\n";
    }

    abstract protected function config();
    abstract public function create(object $object, Generator $faker);
}
