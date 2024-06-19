@extends('layouts.app')


@section('title') Getting Started @endsection


@section('content')
{!! breadcrumbs(['Getting Started' => 'howtoplay']) !!}

<!-- Header -->
    <div class="card">
        <p style="text-align: center; padding-top: 20px;" id="title-1">DATURA MUSTANG</p>
        
        <h5 style="text-align: center;" id="subtitle-1">The Siren Is Calling</h5>
        
        <div class="dropdown-divider"></div>

        <h6 style="text-align: center;">The Datura Mustang is a closed breed created by @vacantfields.</h6>

        <h6 style="text-align: center; padding-left: 50px; padding-right: 50px;">Daturas are feral desert horses closely related to the American Mustang. Their name comes from the Datura flower, a highly poisonous plant, and reflects their unusual immunity to toxins. It is best to admire them from afar, as Daturas are famous for their unfriendly attitude.</h6>

    </div>

    <!-- next --> 
    <div class="div-2">
        <div class="card">
            <div class="card-header">
                <h2 style="text-align: center;">Getting Started</h2>
            </div>
                <div style= "padding-left: 20px">
                    
                    <div class="div-3">
                    <figure>
                        <img src="https://shorturl.at/Ying0" id="img-1">
                        <figcaption style="text-align: center;"> Khaoshund </figcaption>
                    </figure>
                    </div>
                    
                    <h5 style="text-align: center; padding-top: 20px;">Welcome to Datura Mustang!</h5>
                    <h6 style="text-align: center;">
                    This page will include all of the info needed to get you set up and ready to play.
                    </h6>
                
                    <div class="dropdown-divider"></div>

                    <h5 style="text-align: center; padding-top: 20px">
                    Important Notes:
                    </h5>

                    <h6 style="text align: center; padding-top: 20px; padding-right: 20px">
                       <ul id="ul-1">
                        <li> You must be 18+ to play. </li>
                        <br>
                        <li> Datura lore may contain upsetting themes. While we in no way allow the glorification of animal abuse or injury, it does happen. If you are easily upset by those topics we ask you to reconsider if Datura is the right game for you.  </li>
                        <br>
                        <li> Daturas are not given away to new players immediately, and aquiring your first datura may require some drawing and some patience. Stick around and you'll have a large herd in no time! </li>
                        <br>
                        <li> Datura should not be expected to function in the same way as other groups. Comparisons should not be made when playing, as we have our own way of doing things. Please familiarize yourself with our process and rules and avoid making assumptions.</li>
                        <br>
                        <li> Datura is not a genetics heavy harpg. We do not have genotypes and breedings can be random and tricky to predict. Daturas are a newly discovered breed of horse, after all! </li>
                        <br>
                        <li> Daturas are wild horses. They cannot be saddled, ridden, trained or tamed by humans. </li>
                        <br>
                        <li> Our goal is to encourage our players to create quality, story-driven art and to get out of their comfort zones. Farming is not allowed.</li>
                        <br>
                        <li> There are no activity requirements in Datura. </li>
                        </ul>
                    </h6>

                    <div class="dropdown-divider"></div>

                    <h6 style="text-align: center; padding-top: 20px;">
                    Before continuing, a thorough read-through of our terms of service and rules is mandatory. In order to play Datura, you must agree to these terms.
                    </h6>

                    <p style="text-align: center; padding-top: 20px;">
                        <button type="button" id="button-1">RULES AND TOS</button>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <div class="div-4">
        <div class="card">
            <div class="card-header">
                <h2 style="text-align: center;">Creating An Account</h2>
            </div>

            <div style="text-align: center;">

                <h6 style="padding-top: 20px;">

                    <h5 style="margin-right: 50px; margin-left: 50px"> 
                        A Datura account is mandatory to play the game and own daturas.
                        <br>
                        These next steps will walk you through creating an account.
                    </h5>

                    <div class="dropdown-divider"></div>

                    <ul style="margin-right: 50px; margin-left: 50px">
                        <li>A separate social media account with at least five posts is required to create a Datura account. This can be a Deviantart, Instagram or Toyhouse account.</li>
                        <li>Joining our Discord and making an introductory post is also required to create a Datura account. The link to our discord is below when you're ready to join!</li>
                    </ul>

                </h6>

                <div class="dropdown-divider"></div>


                <div>
                    
                    <div style="margin-right: 50px; margin-left: 50px">
                        <h6> <b>1.</b> Register for a Datura.com account and verify your email address. Please use your real age when registering. Your age and birthday are hidden by default on your profile.</h6>
                        <h6> <b>2.</b> Next, link your social media account using the buttons below. Note: All existing players need to use deviantart at first, as this is what's connected to your existing herd. This can be changed later.</h6>
                        <a href="/auth/redirect/deviantart" class="btn btn-outline-primary mr-3">Link <strong>deviantART</strong> Account</a>
                        <a href="http://127.0.0.1:8000/auth/redirect/toyhouse" class="btn btn-outline-primary mr-3">Link <strong>Toyhou.se</strong> Account</a>
                        <a href="http://127.0.0.1:8000/auth/redirect/instagram" class="btn btn-outline-primary mr-3">Link <strong>Instagram</strong> Account</a>
                    </div>

                        <div style ="text-align: center; margin-right: 50px; margin-left: 50px; margin-top: 20px;">
                            <h6> <b>3.</b> Make an introductory post in our Discord server if you are a new player. Existing players will visit our #migrate channel in our discord server instead. </h6>

                            <p style="text-align: center;">
                                <button type="button" id="button-2">Discord Server</button>
                            </p>

                            <h6> <b>4.</b> Transfer items [to figure out]</h6>

                            <h6> <b>5.</b> Once an admin has reviewed your registration, you'll become a verified member! Existing players should see their herd appear on their profile. If there are any issues migrating, feel free to post in #help in our discord server. </h6>
                        </div>

                    </div>
                </div>
        </div>
    </div>

    <div class="div-5">
        
        <div class="card">
            
            <div class="card-header">
                <h2 style="text-align: center;"> 
                    What's Next?
                </h2>
            </div>

            <div style="text-align: center; margin-top: 20px"> 
            
            <h5 style="text-align: center;"> Now that your account is verified, you're free to play Datura!</h5>
            <h6>Before you fully dive into the game and start creating art, it's reccomended that you explore the website here and familiarize yourself with our game functions and how they work. All related info for game functions is on the left navbar under "How To Play." The lore tab in the upper navigation bar has all Datura lore info, along with breed and sub-breed characteristics.</h6>
            <div class="dropdown-divider"></div>

            </div>

        </div>

    </div>

@endsection

@section('sidebar')
    @include('howtoplay._sidebar')
@endsection
