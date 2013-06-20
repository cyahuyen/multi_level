<div id="content-body-wrapper">
    <div id="content-body">
        <div id="question-header">
            <h1 itemprop="name">
                RegEx match open tags except XHTML self-contained tags
            </h1>

        </div>

        <div itemprop="description" class="post-text">
            <p>I need to match all of these opening tags:</p>

            <pre class="lang-html prettyprint prettyprinted" style=""><code><span class="tag">&lt;p&gt;</span><span class="pln">
</span><span class="tag">&lt;a</span><span class="pln"> </span><span class="atn">href</span><span class="pun">=</span><span class="atv">"foo"</span><span class="tag">&gt;</span></code></pre>

            <p>But not these:</p>

            <pre class="lang-html prettyprint prettyprinted" style=""><code><span class="tag">&lt;br</span><span class="pln"> </span><span class="tag">/&gt;</span><span class="pln">
</span><span class="tag">&lt;hr</span><span class="pln"> </span><span class="atn">class</span><span class="pun">=</span><span class="atv">"foo"</span><span class="pln"> </span><span class="tag">/&gt;</span></code></pre>

            <p>I came up with this and wanted to make sure I've got it right. I am only capturing the <code>a-z</code>.</p>

            <pre class="lang-html prettyprint prettyprinted" style=""><code><span class="pln">&lt;([a-z]+) *[^/]*</span><span class="pun">?&gt;</span></code></pre>

            <p>I believe it says:</p>

            <ul>
                <li>Find a less-than, then</li>
                <li>Find (and capture) a-z one or more times, then</li>
                <li>Find zero or more spaces, then</li>
                <li>Find any character zero or more times, greedy, except <code>/</code>, then</li>
                <li>Find a greater-than</li>
            </ul>

            <p>Do I have that right? And more importantly, what do you think?</p>

        </div>

        <div id="answers">
            <div class="subheader answers-subheader">
                <h2>
                    Answer
                </h2>

            </div>
            <div class="post-text"><p>You can't parse [X]HTML with regex. Because HTML can't be parsed by regex. Regex is not a tool that can be used to correctly parse HTML. As I have answered in HTML-and-regex questions here so many times before, the use of regex will not allow you to consume HTML. Regular expressions are a tool that is insufficiently sophisticated to understand the constructs employed by HTML. HTML is not a regular language and hence cannot be parsed by regular expressions. Regex queries are not equipped to break down HTML into its meaningful parts. so many times but it is not getting to me. Even enhanced irregular regular expressions as used by Perl are not up to the task of parsing HTML. You will never make me crack. HTML is a language of sufficient complexity that it cannot be parsed by regular expressions. Even Jon Skeet cannot parse HTML using regular expressions. Every time you attempt to parse HTML with regular expressions, the unholy child weeps the blood of virgins, and Russian hackers pwn your webapp. Parsing HTML with regex summons tainted souls into the realm of the living. HTML and regex go together like love, marriage, and ritual infanticide. The &lt;center&gt; cannot hold it is too late. The force of regex and HTML together in the same conceptual space will destroy your mind like so much watery putty. If you parse HTML with regex you are giving in to Them and their blasphemous ways which doom us all to inhuman toil for the One whose Name cannot be expressed in the Basic Multilingual Plane, he comes. HTML-plus-regexp will liquify the n&#8203;erves of the sentient whilst you observe, your psyche withering in the onslaught of horror. Rege̿̔̉x-based HTML parsers are the cancer that is killing StackOverflow <i>it is too late it is too late we cannot be saved</i> the trangession of a chi͡ld ensures regex will consume all living tissue (except for HTML which it cannot, as previously prophesied) <i>dear lord help us how can anyone survive this scourge</i> using regex to parse HTML has doomed humanity to an eternity of dread torture and security holes <i>using rege</i>x as a tool to process HTML establishes a brea<i>ch between this world</i> and the dread realm of c͒ͪo͛ͫrrupt entities (like SGML entities, but <i>more corrupt) a mere glimp</i>se of the world of reg&#8203;<b>ex parsers for HTML will ins</b>&#8203;tantly transport a p<i>rogrammer's consciousness i</i>nto a w<i>orl</i>d of ceaseless screaming, he comes<strike>, the pestilent sl</strike>ithy regex-infection wil&#8203;<b>l devour your HT</b>&#8203;ML parser, application and existence for all time like Visual Basic only worse <i>he comes he com</i>es <i>do not fi</i>&#8203;ght h<b>e com̡e̶s, ̕h̵i</b>&#8203;s un̨ho͞ly radiańcé de<i>stro҉ying all enli̍̈́̂̈́ghtenment, HTML tags <b>lea͠ki̧n͘g fr̶ǫm ̡yo&#8203;͟ur eye͢s̸ ̛l̕ik͏e liq</b>&#8203;uid p</i>ain, the song of re̸gular exp&#8203;re<strike>ssion parsing </strike>will exti<i>&#8203;nguish the voices of mor&#8203;<b>tal man from the sp</b>&#8203;here I can see it can you see ̲͚̖͔̙î̩́t̲͎̩̱͔́̋̀ it is beautiful t&#8203;</i>he f<code>inal snuf</code>fing o<i>f the lie&#8203;<b>s of Man ALL IS LOŚ͖̩͇̗̪̏̈́T A</b></i><b>LL I&#8203;S L</b>OST th<i>e pon̷y he come</i>s he c̶̮om<strike>es he co</strike><b><strike>me</strike>s t<i>he</i> ich&#8203;</b>or permeat<i>es al</i>l MY FAC<i>E MY FACE ᵒh god n<b>o NO NOO̼</b></i><b>O&#8203;O N</b>Θ stop t<i>he an&#8203;*̶͑̾̾&#8203;̅ͫ͏̙̤g͇̫͛͆̾ͫ̑͆l͖͉̗̩̳̟̍ͫͥͨ</i>e̠̅s<code> ͎a̧͈͖r̽̾̈́͒͑e</code> n<b>&#8203;ot rè̑ͧ̌aͨl̘̝̙̃ͤ͂̾̆ ZA̡͊͠͝LGΌ ISͮ̂҉̯͈͕̹̘̱ T</b>O͇̹̺ͅƝ̴ȳ̳ TH̘<b>Ë͖́̉ ͠P̯͍̭O̚&#8203;N̐Y̡ H̸̡̪̯ͨ͊̽̅̾̎Ȩ̬̩̾͛ͪ̈́̀́͘ ̶̧̨̱̹̭̯ͧ̾ͬC̷̙̲̝͖ͭ̏ͥͮ͟Oͮ͏̮̪̝͍M̲̖͊̒ͪͩͬ̚̚͜Ȇ̴̟̟͙̞ͩ͌͝</b>S̨̥̫͎̭ͯ̿̔̀ͅ</p>

                <hr>

                <p>Have you tried using an XML parser instead?</p>
            </div>
        </div>
    </div>
</div>