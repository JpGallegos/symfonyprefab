namespace Acme\DemoBundle;
 
use Monolog\Logger;
 
class ErrorLogHander extends AbstractProcessingHandler
{
    /**
    * {@inheritdoc}
    */
    protected function write(array $record)
    {
        error_log((string) $record['formatted']);
    }
}