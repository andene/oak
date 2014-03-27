<?hh namespace Oak\Exception;

class NotFoundException extends \Exception {
    public function __construct($message, ?int $code, ?Exception $previous):void {
        parent::__construct($message, $code, $previous);
    }
}
