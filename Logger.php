/*
 * logging to file
 */

class Logger
{
    protected $id;
    protected $file;
    protected $name;
    protected $descriptor;

    function __construct($name,$file)
    {
        if (strpos($file, '/') === false && strpos($file, '..') === false)
            $file = ABSPATH.$file;

        $this->id = mt_rand(0, 10000000);
        $this->file = $file;
        $this->name = $name;


        $this->descriptor = fopen($this->file, 'a');

        $this->Log('Start logging', 'info');
    }

    /*
     * log to file
     */
    public function Log($text, $level='info')
    {
        if (is_array($text))
            $text = print_r($text, 1);

        $message = $this->name.'('.$this->id.') '.date('Y-m-d H:i:s'). ": [$level]: ". $text."\n";
        fwrite($this->descriptor, $message);
    }
    public function __destruct()
    {
        fclose($this->descriptor);
    }
}
