<?php
	$title = "Mid-to-Late Afternoon Edition";
	include('inc/head.php');
?>
			<li class="set twelve_columns contained">
				<ul>
					<li class="set three_columns contained">
						<ul>
							<li class="module syndicate_ear">
								<a href="http://feeds.feedburner.com/inck" title="RSS"><img src="img/feed.png" alt="RSS Chicklet" /></a>
							</li>
							<li class="module ear">
								<div>
									<strong>25&cent;</strong>
									<p>(Mail to 669 Manhattan Avenue, Apartmnet 2, Brooklyn)</p>
								</div>
							</li>
						</ul>
					</li>
					<li class="set six_columns">
						<ul>
							<li class="module flag">
								<h3><span class="letter_i">I</span><span class="letter_n">n</span><span class="letter_c">c</span><span class="letter_k">k</span></h3>
								<cite>Volume One, Issue Three &mdash; Mid-to-Late Afternoon Edition &mdash; Updated: <em>Early Morning</em></cite>
							</li>
						</ul>
					</li>
					<li class="set three_columns">
						<ul>
							<li class="module dog_ear">
								<h3><a href="page.php?number=c7">Letters to the Editor</a></h3>
								<div class="page_corner"><div class="page_fold"></div></div>
							</li>
							<li class="module ear">
								<div>
									<h2>The Weather</h2>
									<p>Warm, Bright and Overcast. Slow Winds Out of the Southeast.</p>
								</div>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="set twelve_columns contained">
				<ul>
					<li class="module header_divider"></li>
					<li class="module banner">
						<h1><a href="page.php?number=c7" name="c7">Bullfight Attended, Analyzed</a></h1>
					</li>
				</ul>
			</li>
			<li class="set nine_columns contained">
				<ul>
					<li class="set three_columns contained">
						<ul>
							<li id="top_right_one" class="module leader hyphenate">
								<h2><a href="page.php?number=c7" name="c7">Bullfight Attended, Analyzed</a></h2>
								<cite>by Nicholas Hall on <em>February 23rd, 2010</em></cite>
								<p><span class="dateline">Mérida</span> A bullfight was attended Saturday, and analyzed for specific cultural, aesthetic and moral features, according to a new report issued by Nick.</p>
								<p>Many interesting judgements and criticisms were drawn from these observations.</p>
								<p>The morality of the bullfight was found to be the least interesting point of analysis by our expert.</p>
								<p>Morality was determined to be essentially counter-analytical. Further, moral arguments against the killing of animals in an emotionally rousing form rather than an industrial one were found to be specious. </p>
								<p>Perhaps most alarmingly, assertions of the animals' suffering showed strong correlations with anthropomorphism and with a silly emotional reaction disguised as an ethical objection.</p>
								<p>Culturally many things were taken to be intimated by the event, including things concerning power structures, gender roles, a fundamental humanism, drinking habits, death, and colonialism.</p>
							</li>
						</ul>
					</li>
					<li class="set six_columns">
						<ul>
							<li class="module cut">
								<a href="http://www.flickr.com/photos/nicholashall/4393709930/" title="EDIFICIO VALERO by Nicholas Hall, on Flickr"><img src="http://farm3.static.flickr.com/2757/4393709930_aa1eda6e9e_b.jpg" alt="EDIFICIO VALERO" /></a>
							</li>
							<li class="set three_columns contained">
								<ul>
									<li id="top_right_two" class="module leader hyphenate">
										<p>One or two of these things were remembered from without the haze of sangria the next day; the rest presumed either forgotten or never worth remembering.</p>
										<p>Those ideas that were not forgotten remain insufficiently conclusive for publication. They will be investigated further while drunk for a later report, according to the researcher, who was drunk at press time.</p>
										<p>Most strikingly implied by the report were aesthetic findings.</p>
										<p>It was concluded from available evidence that</p>
									</li>
								</ul>
							</li>
							<li class="set three_columns">
								<ul>
									<li id="top_right_three" class="module leader hyphenate">
										<p>the bullfight was very beautiful. The confusion of the animal, the glittering surface of the man, the mad profusion of the crowd, these were seen to report upon a topic of grave relevance and reality.</p>
										<p>Seen was an iconography of man's stature between God and nature, the trajectory of every man from pliant creation to a hard death, all the while lashing downward, ultimately lashed by whatever is above him.</p>
										<?php
											$number_of_letters = count(explode("\n\n-----------------\n\n", file_get_contents("letters/c7.txt"))) - 1;
											if($number_of_letters) {
										?>
																<p class="letters">(There <?php echo ($number_of_letters - 1) ? "are" : "is"; ?> currently <?php echo $words[$number_of_letters]; ?> Letter<?php echo $number_of_letters - 1 ? "s" : ""; ?> to the Editor in response to this article.) <a href="page.php?number=c7#top">Read them</a> and <a href="page.php?number=c7#top">write one</a>.</p>
										<?php
											} else {
										?>
																<p class="letters">(There are currently no Letters to the Editor in response to this article.) <a href="page.php?number=c7#top">Write one</a>.</p>
										<?php
											}
										?>
									</li>
								</ul>
							</li>
						</ul>
					</li>
					<li class="set nine_columns contained">
						<ul>
							<li class="module table">
								<h3>The Conjugation of the Preterite Form</h3>
								<table>
									<tr>
										<th></th>
										<th>Yo</th>
										<th>Tú</th>
										<th>El, Ella o Usted</th>
										<th>Nosotros</th>
										<th>Ellos o Ustedes</th>
									</tr>
									<tr>
										<th>-ar</th>
										<td>-é</td>
										<td>-aste</td>
										<td>-ó</td>
										<td>-amos</td>
										<td>-aron</td>
									</tr>
									<tr>
										<th>-er</th>
										<td>-í</td>
										<td>-iste</td>
										<td>-ió</td>
										<td>-imos</td>
										<td>-ieron</td>
									</tr>
									<tr>
										<th>-ir</th>
										<td>-í</td>
										<td>-iste</td>
										<td>-ió</td>
										<td>-imos</td>
										<td>-ieron</td>
									</tr>
								</table>
							</li>
							<li class="set three_columns contained">
								<ul>
									<li class="module leader hyphenate">
										<h2><a href="page.php?number=h7" name="h7">Conversation About Whorehouses Barely Understood</a></h2>
										<cite>by Nicholas Hall on <em>January 30th, 2010</em></cite>
										<p><span class="dateline">Mérida</span> A conversations about whorehouses was barely understood on Saturday, in the kitchen of the house where Nick resides, between Ramon, a man who occasionally stays in the house, and two other men, a local friend named Nicolás, and another who is apparently a lawyer.</p>
										<p>The lawyer and Nicolás both grew up in Mérida, and Ramon grew up in Caracas, making his perspective on the existence of the whorehouse under discussion less valid than those of the other men.</p>
										<p>The whorehouse was barely understood to have at times been a movie theatre as well, or perhaps to have been nominally a movie</p>
									</li>
								</ul>
							</li>
							<li class="set three_columns">
								<ul>
									<li class="module leader hyphenate">
										<p>theatre while in fact operating as a whorehouse.</p>
										<p>The words 'puta' and 'putaria' were interpreted to signify that the conversation being had concerned whorehouses. </p>
										<p>Additionally the words 'mierda' and 'coño' were in heavy use. Their purpose was understood primarily to be essentially that of punctuation and emphasis.</p>
										<p>The conversation was believed to have concerned at times the specific year in which the supposed movie theatre had operated in this capacity. The years 1975, 1974, and 1970 were debated has having potentially been the year of the building's provision of said services.</p>
										<p>The night began with the innocent eating of dinner, during which 'Cuba Libres' were offered, thereby commencing the conversation in question. <a href="page.php?number=h7&amp;from=214#h7" class="jumpline">Continued, with Letters to the Editor, on Page H7 &raquo;</a></p>
									</li>
								</ul>
							</li>
							<li class="set three_columns">
								<ul>
									<li class="module leader hyphenate">
										<h2><a href="page.php?number=n1" name="n1">Real Things Happen</a></h2>
										<cite>by Nicholas Hall on <em>January 27th, 2010</em></cite>
										<p><span class="dateline">Mérida</span> Real things happened yesterday and Monday in Mérida, as students took to the streets to protest the shutdown of RCTV, one the last remaining broadcast networks in Venezuela which had been openly critical of the Chávez government.</p>
										<p>On Monday students were seen throwing rocks and moving in groups, armed with molotov cocktails fashioned out of regional beer bottles. Many had t-shirts tied around their faces. They blocked traffic in a series of streets in the downtown area, using chairs and tires that were then set on fire. </p>
										<p>Police in riot gear massed throughout the downtown area over the course of the afternoon.</p>
										<p>Later in the <a href="page.php?number=n1&amp;from=106#n1" class="jumpline">Continued, with Letters to the Editor, on Page N1 &raquo;</a></p>
									</li>
								</ul>
							</li>
						</ul>
					</li>
				</ul>
			</li>
			<li class="set three_columns">
				<ul>
					<li class="module leader hyphenate">
						<h2><a href="page.php?number=r16" name="r16">The Apartment Hunt: The Big Deal: Money Matters: Traveler's Journal: Things</a></h2>
						<cite>by Nicholas Hall on <em>February 12th, 2010</em></cite>
						<p>In this installment in The Hunt, we look at the Deal of the Week, and learn some lessons from the Money Man to record in our Traveler's Journal.</p>
						<p>Last we heard from our Hunter-Dealer-Man-Traveler, he had been in the thick of negotiations for a new property-adventure-home. After some hairy experiences and excursions and confabs he had decided on the place of his dreams/budget.</p>
						<p>When we left him off, he was working through the tangle of paying someone a few hundred dollars, and struggling with new complexities like talking, writing emails, and receiving any kind of response. All of these things can pose new challenges to someone new to the world of financio-real-adventure-talks.</p>
						<p>In response to the volatile worlds of these various mythologized market segments that we present as digestible power narratives, Nick had to make some tough decisions and have some tough conversations.</p>
						<p>First he had to write another email in Spanish to the lady with the apartment and await a response, and then ask the lady with his current apartment if he could stay on, and how much that would cost. After lengthy ten-minute negotiations they agreed on a ridiculously equitable price and then started drinking rum listening to everyone else discuss politics.</p>
						<p>Then Nick had to break off talks with the other lady, which first meant a long discovery process of how to even get in touch with her. That ultimately came to fruition when she walked into his school one day. After a tense series of exchanges over how to say things in Spanish, the lady figured out what he was saying and was mildly disappointed.</p>
						<p>Lessons Learned: In today's market you have to be aggressive, and you can't be afraid to push the limits of the words you know how to say. Forces may buffet from every direction, but most important is that you set a location and a price and stick to it, unless something changes and you don't really want to any more.</p>
<?php
	$number_of_letters = count(explode("\n\n-----------------\n\n", file_get_contents("letters/r16.txt"))) - 1;
	if($number_of_letters) {
?>
						<p class="letters">(There <?php echo ($number_of_letters - 1) ? "are" : "is"; ?> currently <?php echo $words[$number_of_letters]; ?> Letter<?php echo $number_of_letters - 1 ? "s" : ""; ?> to the Editor in response to this article.) <a href="page.php?number=r16#top">Read them</a> and <a href="page.php?number=r16#top">write one</a>.</p>
<?php
	} else {
?>
						<p class="letters">(There are currently no Letters to the Editor in response to this article.) <a href="page.php?number=r16#top">Write one</a>.</p>
<?php
	}
?>
					</li>
				</ul>
			</li>
<?php
	include('inc/foot.php');
?>