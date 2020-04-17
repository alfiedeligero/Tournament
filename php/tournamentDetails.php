<?php
//this will server as the languagePack
define( "STATUS", "STATUS");
define( "DETAILS", "DETAILS");
define("HELP", "HELP");
define("TOURNAMENTNAME", "TOURNAMENT NAME");
define("TIMER", "TIMER");
define("ENTRYFEE", "ENTRY FEE AMOUNT: ");
define("GAMETITLE","GAME TITLE: ");
define("NAMEOFENTRANT", "NAME OF ENTRANT");
define("PRIZELISTING", "CURRENT PRIZES");
define("HELPCONTENT", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum velit et ante posuere, sed posuere leo commodo. Suspendisse ac urna augue. Nunc dignissim scelerisque massa, ut pellentesque nunc pulvinar in. Cras massa urna, dictum in venenatis vitae, volutpat sit amet nulla. Curabitur suscipit, felis vitae congue ultrices, est purus facilisis quam, a posuere mauris orci sit amet diam. Proin id velit libero. Pellentesque ligula purus, hendrerit nec hendrerit in, accumsan eu diam. Aenean a luctus massa. Mauris dui purus, lacinia nec tempus vel, varius eget orci. Proin quis faucibus justo. Nulla sagittis non tellus eu porttitor. Vivamus aliquam tempus varius. Etiam cursus pharetra luctus.");


define( "TIMERAMAINING", "TIME REMAINING");
define( "DAYS", "Days");
define( "HOURS", "Hours");
define( "MINUTES", "Minutes");
define( "SECONDS", "Seconds");

define( "HEADER", "HEADER");
define( "GAME", "Game: ");
define( "ENTRY", "Your Entry: ");
define( "ROUNDS", "Rounds played: ");
define( "CURRENTSCORE", "Current Score: ");
define( "CURRENTRANK", "Current Rank: ");
define( "CURRENTPRIZE", "Current Prize: ");


define( "LEADERS", "LEADERS");
define( "NAME", "NAME");
define( "RANK", "RANK");
define( "PRIZE", "PRIZE");
define( "SCORES", "SCORE");

define( "START", "Starts: ");
define( "END", "Ends: ");
define( "TIMELIMIT", "Time Limit: ");
define( "MAXROUNDS", "Maximum rounds: ");
define( "TIES", "Ties: ");
define( "PRIZESPLITTING", "Prize Splitting");
define( "ENTRIESPERCOSTUMER", "Entries per costumer: ");
define( "MAXENTRIES", "Maximum entries: ");
define( "TIESHELP", "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque vestibulum velit et ante posuere, sed posuere leo commodo.");


define("GAMELOGO_PATH", "res/Images/Logo/");


define("GAME_LOGO", "http://staging0.apsgrp.com/common/Launcher_Data/images/icons/755_SpeedDemons/icon1.png");
define('GAME_TITLE', 'Speed Demons');

define("GameName_99755", "Speed Demons");
?>

<?php include($_GET['tournamentPath'].'php/Status.php') ?>
<?php include($_GET['tournamentPath'].'php/Details.php') ?>
<?php include($_GET['tournamentPath'].'php/Help.php') ?>


<script>
	//loadTournamentCss('css/Slots_Mobile.css');
   
    
    
    var tournament_details_container;
    var collapse_wrapper;
    var background_container;
    var expand_wrapper_container;
    var expandTab_container;
    var collapse_wrapper_container;
    var status_Tab;
    var details_Tab;
    var help_Tab;
    var collapse_BTN;
    // var expand_BTN;
    var status_container;
    var details_container;
    
    var help_container;
    // var _this;
    var languagePack
    var translations;
    var gameInfoData;

    var _assetSize;
    var _gameID;
    var _contestData;
    var _logoPath;
    var _logoName;
    // var TournamentGameValues;
    
    

    function TournamentDetails(_params){

        this.gameParams = _params;
        var _this = this;

        this.onClick = function(){
            
            switch(this.id){
                case 'collapse_BTN':
                    console.log('-----------------',this);

                    if(expand_wrapper_container.classList.contains('slot_div_show')){
                        expand_wrapper_container.classList.remove('slot_div_show');
                    }
                    expand_wrapper_container.classList.add('slot_div_hide');

                    _this.update({type:'REMOVE_ACTIVE_TAB'})


                    setTimeout(function(){
                        expand_wrapper_container.style.display = 'none';
                        collapse_wrapper_container.style.display = 'block';
                        document.getElementById("tournament_container_div").style.position = 'relative';
                    },1000)

                    collapse_BTN.removeEventListener("click",_this.onClick);
                    expand_BTN.addEventListener("click",_this.onClick);
                break;
                case 'status_Tab':
                    status_container.style.display = 'inline-block';
                    details_container.style.display = 'none';
                    help_container.style.display = 'none';

                    //chester
                    _this.update({type:'REMOVE_ACTIVE_TAB'}); 
                    status_Tab.style.pointerEvents = 'none';
                    status_Tab.classList.add('navExpanded_Tab_active');
                    
                break
                case 'details_Tab':
                    details_container.style.display = 'inline-block';
                    status_container.style.display = 'none';
                    help_container.style.display = 'none';
                    
                    //chester
                    _this.update({type:'REMOVE_ACTIVE_TAB'}); 
                    details_Tab.style.pointerEvents = 'none';
                    details_Tab.classList.add('navExpanded_Tab_active');
                break
                case 'help_Tab':
                    help_container.style.display = 'inline-block';
                    status_container.style.display = 'none';
                    details_container.style.display = 'none';
                    
                    //chester
                    _this.update({type:'REMOVE_ACTIVE_TAB'});    
                    help_Tab.style.pointerEvents = 'none';
                    help_Tab.classList.add('navExpanded_Tab_active');
                break
            }
            
        };
        
        this.update = function(_params){
            // console.log('TOURNAMENT DETAILS UPDATE:',_params);
            switch(_params.type){
                case 'GameInfo':
                    console.log('DETAILS INFO',_params, _assetSize);
                    gameInfoData = _params.data;
                    _assetSize = _params.assetSize;

                    loadTournamentCss(this.tournametAssetsPath + 'css/Tournament_Details_' + _assetSize +'.css');
                    loadTournamentCss(this.tournametAssetsPath + 'css/Status_TAB_' + _assetSize +'.css');
                    break;
                case 'EOS':
                    console.log('DETAILS EOS',_params);
                    break;
                case 'BET':
                    console.log('DETAILS BET',_params);
                    break;
                case 'GetTournamentDetails':
                    console.log('DETAILS GET DETAILS',_params);
                    _gameID = _params.data.contest.gameID;
                    _contestData = _params.data;
                    init_Status();
                    init_Details(this.tournametAssetsPath);
                    init_Help();

                    
                    
                    break;
                case 'DEFAULT':
                    console.log('DEFAULT',_params);
                    expand_wrapper_container = document.createElement('div');
                    expand_wrapper_container.id = 'Tournamnet_Expand_Wrapper';
                    expand_wrapper_container.classList.add("slot_div_hide");
                    tournament_details_container.appendChild(expand_wrapper_container);

                    collapse_wrapper_container = document.createElement('div');
                    collapse_wrapper_container.id = 'Tournamnet_Collapse_Wrapper';
                    collapse_wrapper_container.classList.add("Tournamnet_Collapse_Wrapper");
                    tournament_details_container.appendChild(collapse_wrapper_container);


                    expandTab_container = document.createElement('div');
                    expandTab_container.id = 'expandTab_container';
                    expandTab_container.classList.add("expandTab_container");
                    expand_wrapper_container.appendChild(expandTab_container);

                    status_Tab = document.createElement('div');
                    status_Tab.id = 'status_Tab';
                    status_Tab.classList.add("navExpanded_Tab");
                    status_Tab.innerHTML = "<?php echo STATUS ?>";
                    expandTab_container.appendChild(status_Tab);

                    details_Tab = document.createElement('div');
                    details_Tab.id = 'details_Tab';
                    details_Tab.classList.add("navExpanded_Tab");
                    details_Tab.innerHTML = "<?php echo DETAILS ?>";
                    expandTab_container.appendChild(details_Tab);

                    help_Tab = document.createElement('div');
                    help_Tab.id = 'help_Tab';
                    help_Tab.classList.add("navExpanded_Tab");
                    help_Tab.innerHTML = "<?php echo HELP ?>";
                    expandTab_container.appendChild(help_Tab);

                    collapse_BTN = document.createElement('div');
                    collapse_BTN.id = 'collapse_BTN';
                    collapse_BTN.classList.add("collapse_BTN");
                    collapse_BTN.innerHTML = '<<';
                    expandTab_container.appendChild(collapse_BTN);

                    status_container = document.createElement('div');
                    status_container.id = 'status_container';
                    status_container.classList.add("content_container");
                    expand_wrapper_container.appendChild(status_container);

                    details_container = document.createElement('div');
                    details_container.id = 'details_container';
                    details_container.classList.add("content_container");
                    expand_wrapper_container.appendChild(details_container);

                    help_container = document.createElement('div');
                    help_container.id = 'help_container';
                    help_container.classList.add("content_container");
                    expand_wrapper_container.appendChild(help_container);


                    expand_wrapper_container.style.display = 'none';

                    break;

                case 'SHOW_TOURNAMENT_DETAILS':

                    console.log('SHOW_TOURNAMENT_DETAILS',_params, gameInfoData);

                    _logoPath = _this.tournametAssetsPath + "<?php echo GAMELOGO_PATH ?>" +  "GAMELOGO_" + _gameID + ".png";
                    _logoName = "<?php echo constant('GameName_'. $_GET['gameId']); ?>";

                    console.log('--------------------', _logoName);
                    // debugger;
                    // _this.tournametAssetsPath + "res/Images/Logo/" + _assetSize + "/" + _gameID + ".png";
                    TournamentStatusValue(_contestData, gameInfoData);
                    TournamentDetailsValue(_contestData,gameInfoData);

                    document.getElementById("tournament_container_div").style.position = 'static';
                    collapse_wrapper_container.style.display = 'none';
                    expand_wrapper_container.style.display = 'inline-block';

                    status_container.style.display = 'inline-block';
                    details_container.style.display = 'none';
                    help_container.style.display = 'none';

                    status_Tab.classList.add('navExpanded_Tab_active');
                    status_Tab.style.pointerEvents = '';

                    if(expand_wrapper_container.classList.contains('slot_div_hide')){
                        expand_wrapper_container.classList.remove('slot_div_hide');
                    }

                    expand_wrapper_container.classList.add('slot_div_show');
                    // expand_BTN.removeEventListener("click",_this.onClick);
                    collapse_BTN.addEventListener("click",_this.onClick);
                    status_Tab.addEventListener("click",_this.onClick);
                    details_Tab.addEventListener("click",_this.onClick);
                    help_Tab.addEventListener("click",_this.onClick);                    

                    
                    break;
                case 'REMOVE_ACTIVE_TAB':
                    if(status_Tab.classList.contains('navExpanded_Tab_active')){
                        status_Tab.classList.remove('navExpanded_Tab_active');
                        status_Tab.style.pointerEvents = '';
                    }
                    if(details_Tab.classList.contains('navExpanded_Tab_active')){
                        details_Tab.classList.remove('navExpanded_Tab_active');
                        details_Tab.style.pointerEvents = '';
                    }
                    if(help_Tab.classList.contains('navExpanded_Tab_active')){
                        help_Tab.classList.remove('navExpanded_Tab_active');
                        help_Tab.style.pointerEvents = '';
                    }
                    break;
                case 'UPDATE_TIME':
                    if(_tournamentStatus){
                        _tournamentStatus.update(_params);
                    }
                    if(_tournamentDetails){
                        _tournamentDetails.timerUpdate(_params);
                    }
                break;
            }
        }
        
        this.init = function(_params){
            console.log('TOURNAMENT DETAILS INITIALIZE:',_params); 
            
            //parent will be the container for your div
            if(_params){
                if(_params.parent){
                    tournament_details_container = _params.parent;
                }
            }
            this.tournametAssetsPath = decodeURIComponent(this.gameParams.tournamentAssetPath);
            

            console.log('+++++++++++++++INIT+++++++++++++++')
            this.update({type:'DEFAULT'});
        }
        
        
        
    }

        </script>