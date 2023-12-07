# Day 05

I was so happy to have a solution that didn't brute force part 2 (<1s) and solved the test data
until AoC told me my answer was too low.
So I've searched for the better part of 2h for the bug, even tried my wrong answer times again.
Luckily for me -- after massive frustration -- I entered the second best solution instead and was
stunned to see it being right ;)

Today at Day 07 (--- Day 7: Camel Cards ---) I've some time to revisit the problem. 
Since the culprit seems to be the range calculations I decided to delegate that to a 
Range-Class that I can easily unit test.
As I'm working on an JetBrains Ultimate Plan I decided to give their AI a look.

This is how it went:

## Jetbrains AI ( _Jay_ ) Usage
After shortcutting the 

### [src/Ranges/Range.php](../src/Ranges/Range.php)
First tried invocation inline in the body of method intersect. 
Alas, Jay wanted to put the (elegant) code produced at the beginning of the file.
So manual mouse-handling required to copy/paste the function into the class body.
I'm not sure, if it's an error or wrong usage.

After that I wanted to test the range class and discussed it with Jay.
Here Jays response to the last of the following question:

    Sure, here are all your inquiries in order:

    1. "create unit tests for the Range class"
    2. "add tests for intersection and difference"
    3. "add tests for failed intersection and failed difference"
    4. "add test for difference resulting in two Range-Objects being returned"
    5. "add test for empty intersection between two ranges"
    6. "can you get me all my inputs in order? I want to document my chat with you for future reference"

The results can be found in [tests/Ranges/RangeTest.php](../tests/Ranges/RangeTest.php). 
I had to change some method names. 
In my class the intersection-method is called intersect, so I should have asked for that. 
Jay didn't anticipate that the difference of intervals (2) isn't neccessarily a single range but with (4) 
the coverage was at 95%, and (5) led to 100% coverage. Job done!
