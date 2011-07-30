PHPArgumentParser
=================

The aim of this package is to make it easier to create command line applications
is PHP. It process arguments into valid php data types and provides automatic
help and version arguments.

Usage
-----

1. Create a new argument parser object

    $parser = new ArgumentParser();

2. Add some arguments

    $parser->addArgument(array(
        'argument' => '--my-argument',
        'type' => 'string',
        'default' => 'foo', // default argument
    ));