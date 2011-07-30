PHPArgumentParser
=================

The aim of this package is to make it easier to create command line applications
is PHP. It process arguments into valid php data types and provides automatic
help and version arguments.

Usage
-----

1) Create a new argument parser object passing it name, description and version

    $parser = new ArgumentParser();

2) Add some arguments

    $parser->addArgument(array(
        'argument' => '--my-argument', // long argument name
        'alias'    => '-m', // short argument
        'type'     => 'string', // the PHP data type
        'default'  => 'foo', // default argument,
        'helpText' => 'This is a help message...',
        'variable' => 'myArg', // a variable name to access it later
    ));

3) Parse the arguments

    $args = $parser->parseArguments();

4) Argument values are the available as an array or properties

    $args['myArg']; // 'foo'
    $args->myArg; // 'foo'

Note
----

My default, the version (-v, --version) and help (-h, --help) arguments are 
set automatically.