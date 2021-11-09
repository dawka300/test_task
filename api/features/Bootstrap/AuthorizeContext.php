<?php

namespace Features\Bootstrap;

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode;

class AuthorizeContext
{
    /**
     * @When I send :arg1 request with required headers to :arg2 with body:
     */
    public function iSendRequestWithRequiredHeadersToWithBody($arg1, $arg2, PyStringNode $string)
    {
        throw new PendingException();
    }

    /**
     * @Then the JSON node :arg1 should contain :arg2
     */
    public function theJsonNodeShouldContain($arg1, $arg2)
    {
        throw new PendingException();
    }
}
