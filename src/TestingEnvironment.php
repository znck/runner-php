<?php namespace Znck\Runner;

    /**
     * This file belongs to runner-php.
     *
     * Author: Rahul Kadyan, <hi@znck.me>
     * Find license in root directory of this project.
     */
/**
 * Class TestCaseRunner
 *
 * @package Znck\Runner
 */
class TestingEnvironment
{
    /**
     * @type int
     */
    protected $time;
    /**
     * @type int
     */
    protected $memory;
    /**
     * @type int
     */
    protected $stack;
    /**
     * @type int
     */
    protected $output;
    /**
     * @type int
     */
    protected $files;
    /**
     * @type int
     */
    protected $processes;
    /**
     * @type string
     */
    protected $analysis;

    /**
     * TestCaseRunner constructor.
     *
     * @param int    $time
     * @param int    $memory
     * @param int    $stack
     * @param int    $output
     * @param int    $files
     * @param int    $processes
     * @param string $analysis
     */
    public function __construct(
        $time = 2,
        $memory = 6410241024, // 64MB
        $stack = 810241024, // 8MB
        $output = 5010241024, // 50MB
        $files = 16,
        $processes = 1,
        $analysis = 'analysis.yml'
    ) {
        $this->time = $time;
        $this->memory = $memory;
        $this->stack = $stack;
        $this->output = $output;
        $this->files = $files;
        $this->processes = $processes;
        $this->analysis = $analysis;
    }

    /**
     * @return int
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * @param int $time
     */
    public function setTime($time)
    {
        $this->time = $time;
    }

    /**
     * @return int
     */
    public function getMemory()
    {
        return $this->memory;
    }

    /**
     * @param int $memory
     */
    public function setMemory($memory)
    {
        $this->memory = $memory;
    }

    /**
     * @return int
     */
    public function getStack()
    {
        return $this->stack;
    }

    /**
     * @param int $stack
     */
    public function setStack($stack)
    {
        $this->stack = $stack;
    }

    /**
     * @return int
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * @param int $output
     */
    public function setOutput($output)
    {
        $this->output = $output;
    }

    /**
     * @return int
     */
    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param int $files
     */
    public function setFiles($files)
    {
        $this->files = $files;
    }

    /**
     * @return int
     */
    public function getProcesses()
    {
        return $this->processes;
    }

    /**
     * @param int $processes
     */
    public function setProcesses($processes)
    {
        $this->processes = $processes;
    }

    /**
     * @return string
     */
    public function getAnalysis()
    {
        return $this->analysis;
    }

    /**
     * @param string $analysis
     */
    public function setAnalysis($analysis)
    {
        $this->analysis = $analysis;
    }

    public function command()
    {
        $bin = static::binary();

        return "{$bin} --analysis='{$this->analysis}' --stack={$this->stack} --memory={$this->memory} --output-size={$this->output} "
        . "--time={$this->time} --open-files={$this->files} --processes={$this->processes}";
    }

    /**
     * @return string executable binary.
     * @static
     */
    public static function binary()
    {
        $binary = dirname(__DIR__) . '/runner/bin/runner';
        if (!file_exists($binary)) {
            chdir(dirname(__DIR__) . "/runner/");
            exec('make');
        }

        return $binary;
    }
}