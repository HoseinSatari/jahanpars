<?php


namespace App\Helper\cart;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Str;


class CartServic
{
    public $cart;
    protected $name = 'cart';

    public function __construct()
    {
        $this->cart = collect(json_decode(request()->cookie($this->name), true)) ?? collect([]);
    }

    public function put(array $value, $obj = null)
    {
        if (!is_null($obj) and $obj instanceof Model) {
            $value = array_merge($value, [
                'id' => Str::random(10),
                'subject_id' => $obj->id,
                'subject_type' => get_class($obj),
            ]);
        } elseif (!isset($value['id'])) {
            $value = array_merge($value, [
                'id' => Str::random(10),
            ]);

        }
        $this->cart->put($value['id'], $value);
        //  session()->put($this->name, $this->cart);
        $this->StoreCookie();

        return $this;

    }

    public function update($key, $option)
    {
        $item = collect($this->get($key, false));

        if (is_numeric($option)) {
            $item = $item->merge([
                'quantity' => $item['quantity'] + $option
            ]);
        }
        if (is_array($option)) {
            $item = $item->merge($option);
        }
        $this->put($item->toArray());

        return $this;
    }

    public function has($key)
    {
        if ($key instanceof Model) {
            return !is_null(
                $this->cart->where('subject_id', $key->id)->where('subject_type', get_class($key))->first()
            );
        }

        return !is_null(
            $this->cart->firstWhere('id', $key)
        );
    }

    public function get($key, $withrelationship = true)
    {
        $item = $key instanceof Model
            ? $this->cart->where('subject_id', $key->id)->where('subject_type', get_class($key))->first()
            : $this->cart->firstWhere('id', $key);

        return $withrelationship ? $this->whitRelationshipIfExist($item) : $item;
    }

    public function all()
    {
        $cart = $this->cart;

        $cart = $cart->map(function ($item) {
            return $this->whitRelationshipIfExist($item);
        });

        return $cart;
    }

    protected function whitRelationshipIfExist($item)
    {

        if (isset($item['subject_id']) && isset($item['subject_type'])) {
            $class = $item['subject_type'];
            $subject = (new $class())->find($item['subject_id']);
            $item[strtolower(class_basename($class))] = $subject;

            unset($item['subject_id']);
            unset($item['subject_type']);

            return $item;
        }

        return $item;
    }

    public function count($key)
    {
        if (!$this->has($key)) return 0;

        return $this->get($key)['quantity'];
    }

    public function delete($key)
    {
        if ($this->has($key)) {
            $this->cart = $this->cart->filter(function ($item) use ($key) {
                if ($key instanceof Model) {
                    return ($item['subject_id'] != $key->id) and ($item['subject_type'] != get_class($key));
                }
                return $item['id'] != $key;
            });

            $this->StoreCookie();

            return true;
        }
        return false;
    }

    public function flush()
    {
        $this->cart = collect([]);

        $this->StoreCookie();

        return $this;
    }

    public function instance(string $name)
    {

        $this->cart = collect(json_decode(request()->cookie($name), true)) ?? collect([]);
        $this->name = $name;
        return $this;
    }

    public function StoreCookie(): void
    {
        Cookie::queue($this->name, $this->cart->toJson(), 60 * 24 * 7);
    }


}
