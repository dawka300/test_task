Feature: Authorize by password
    As a registered customer I want to log in using my email and password
    POST /login



    Scenario: Customer sends invalid json
        When I send "POST" request with required headers to "/authentication_token" with body:
    """
    {}
    """
        Then the response status code should be 400

    Scenario Outline: Customer sends email in invalid format
        When I send "POST" request with required headers to "/authentication_token" with body:
    """
    {
        "email": "<email>",
        "password": "Test1234!",
    }
    """
        Then the response status code should be 400

        Examples:
            | email      |
            | test       |
            | test@upaid |
            | @upaid.pl  |
            | 1234       |

