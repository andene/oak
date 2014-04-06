<?hh namespace Oak\Exception;

class NotFoundException extends \Exception {
    public function __construct($message, ?int $code, ?\Exception $previous):void {

        if(null === $code) {
            $code = 0;
        }
        if(null === $previous) { {
            $previous = "";
        }}

        parent::__construct($message, $code);
    }
}
