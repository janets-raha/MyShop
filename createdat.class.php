<?php

class Created_at extends DateTime
{
    public function __toString()
    {
        return $this->format("Y-m-d H:i:s");
    }
}



?>
