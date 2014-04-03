<?hh

require "routes.php";


/**
 * Public Path
 */
class Config implements \ArrayAccess {

    public $container;
    public function offsetSet($offset, $value):void {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }
    public function offsetExists($offset):bool {
        return isset($this->container[$offset]);
    }
    public function offsetUnset($offset) {
        unset($this->container[$offset]);
    }
    public function offsetGet($offset) {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }


}
 $config = new Config();
 $config['publicPath'] = __DIR__."/../public";
 $config['appPath'] = __DIR__."/../app";
 $config['viewFolder'] = __DIR__."/../app/View";

 Container::set('config', $config);
