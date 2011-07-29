<?php

namespace Wildkat\ArgumentParser\Arguments;

interface ArgumentInterface
{
    const TYPE_SINGLE = 0;
    const TYPE_WORD   = 1;
    
    public function showHelp();
    
}
