<?php
//this will server as the languagePack
define("SCORE", "SCORE:");
define("TIMER", "TIMER:");
define("ROUND_REMAINING", "ROUND:");
define("BTN_TOURNAMENT_LABEL", "");
?>

<script type="text/javascript">
	/*//load CSS
	loadTournamentCss = function(_filename) {
        try{
            //_filename += '?buster='+_gameProps.cacheBuster;
            var fileref = document.createElement("link");
            fileref.setAttribute("rel", "stylesheet");
            fileref.setAttribute("type", "text/css");
            fileref.setAttribute("href", _filename);
            if (typeof fileref != "undefined") {
                document.getElementsByTagName("head")[0].appendChild(fileref);
            }    
        }catch(e){
            console.log('CSS LOADING ERROR:',e);
        }
        
    };*/
    function TournamentGame(_params){
        this.gameParams = _params;
        var _tournamentGame = this;
        
        //hack
        if(parseInt(this.gameParams.gameID) < 99000){
            if(parseInt(this.gameParams.gameID) < 1000){
                //slots
                this.gameParams.gameID = parseInt(this.gameParams.gameID) + 99000;
            }else{
                //tablegames
                this.gameParams.gameID = parseInt('99'+this.gameParams.gameID);
            }
            
        }
        
        this.remainingTimeInSeconds = 0;
        this.remainingTimeTimer = null;
        this.remainingTime_temp = 0;
        this.remainingTime_Days = 0;
        this.remainingTime_Hours = 0;
        this.remainingTime_Minutes = 0;
        this.remainingTime_Seconds = 0;
        this.remainingTime_Display = '';
        
        //the div container where this will be added. for now just using document
        this.game_div_main_parent = document.body;
        this.tournament_align_div;
        
        this.game_div_main_container;

        //container for all game content
        this.game_div_tournament_container;
        
        //info
        //divs
        this.game_div_info_container;
        this.game_div_info_bg;
        this.game_div_info_content_container;

        this.game_div_info_score_container;
        this.game_div_info_score_label;
        this.game_div_info_score_value;

        this.game_div_info_round_container;
        this.game_div_info_round_label;
        this.game_div_info_round_value;

        this.game_div_info_timer_container;
        this.game_div_info_timer_label;
        this.game_div_info_timer_value;

        //values
        this.slotCurrentScore = '99,999.99';
        this.slotCurrentTime = '99:99:99';
        this.slotCurrentRound = '99/100';


        //Tournament BTN
        //divs
        this.game_div_tournament_btn;
        this.game_div_tournament_bg;
        this.game_div_tournament_label;

        this.windowWidth;
        this.windowHeight;
        this.dimensionWidth;
        this.dimensionHeight;
        this.assetSize;
        this.alignPositions;

        this.init = function(_params){
            if(_params){
                if(_params.parent){
                    this.game_div_main_parent = _params.parent;
                }
                if(_params.tournamentDetails){
                    this.tournamentDetails = _params.tournamentDetails;
                }
                if(_params.align_div){
                    this.tournament_align_div = _params.align_div;
                }
            }
            
            //main container
            this.game_div_main_container = document.createElement('div');
            this.game_div_main_container.id = 'game_div_main_container';
            
            //
            this.game_div_tournament_container = document.createElement('div');
            this.game_div_tournament_container.id = 'game_div_tournament_container';
            this.game_div_main_container.appendChild(this.game_div_tournament_container);
            
            if(_params.tournament_details_container_div){
                this.game_div_main_container.appendChild(_params.tournament_details_container_div);
            }
            
            //info contents
            this.game_div_info_container = document.createElement('div');
            this.game_div_info_container.id = 'game_div_info_container';
            this.game_div_tournament_container.appendChild(this.game_div_info_container);

            //bg
            this.game_div_info_bg = document.createElement('div');
            this.game_div_info_bg.id = 'game_div_info_bg';
            this.game_div_info_container.appendChild(this.game_div_info_bg);

            //content
            this.game_div_info_content_container = document.createElement('div');
            this.game_div_info_content_container.id = 'game_div_info_content_container';
            this.game_div_info_container.appendChild(this.game_div_info_content_container);

            //score
            this.game_div_info_score_container = document.createElement('div');
            this.game_div_info_score_container.id = 'game_div_info_score_container';
            this.game_div_info_content_container.appendChild(this.game_div_info_score_container);

            this.game_div_info_score_label = document.createElement('div');
            this.game_div_info_score_label.id = 'game_div_info_score_label';
            this.game_div_info_score_label.innerHTML = "<?php echo SCORE ?>";
            this.game_div_info_score_container.appendChild(this.game_div_info_score_label);

            this.game_div_info_score_value = document.createElement('div');
            this.game_div_info_score_value.id = 'game_div_info_score_value';
            this.game_div_info_score_value.innerHTML = this.slotCurrentScore;
            this.game_div_info_score_container.appendChild(this.game_div_info_score_value);


            //round
            this.game_div_info_round_container = document.createElement('div');
            this.game_div_info_round_container.id = 'game_div_info_round_container';
            this.game_div_info_content_container.appendChild(this.game_div_info_round_container);

            this.game_div_info_round_label = document.createElement('div');
            this.game_div_info_round_label.id = 'game_div_info_round_label';
            this.game_div_info_round_label.innerHTML = "<?php echo ROUND_REMAINING ?>";
            this.game_div_info_round_container.appendChild(this.game_div_info_round_label);

            this.game_div_info_round_value = document.createElement('div');
            this.game_div_info_round_value.id = 'game_div_info_round_value';
            this.game_div_info_round_value.innerHTML = this.slotCurrentRound;
            this.game_div_info_round_container.appendChild(this.game_div_info_round_value);


            //timer
            this.game_div_info_timer_container = document.createElement('div');
            this.game_div_info_timer_container.id = 'game_div_info_timer_container';
            this.game_div_info_content_container.appendChild(this.game_div_info_timer_container);

            this.game_div_info_timer_label = document.createElement('div');
            this.game_div_info_timer_label.id = 'game_div_info_timer_label';
            this.game_div_info_timer_label.innerHTML = "<?php echo TIMER ?>";
            this.game_div_info_timer_container.appendChild(this.game_div_info_timer_label);

            this.game_div_info_timer_value = document.createElement('div');
            this.game_div_info_timer_value.id = 'game_div_info_timer_value';
            this.game_div_info_timer_value.innerHTML = this.slotCurrentTime;
            this.game_div_info_timer_container.appendChild(this.game_div_info_timer_value);


            //tournament button
            this.game_div_tournament_btn = document.createElement('div');
            this.game_div_tournament_btn.id = 'game_div_tournament_btn';
            this.game_div_tournament_container.appendChild(this.game_div_tournament_btn);

            this.game_div_tournament_bg = document.createElement('div');
            this.game_div_tournament_bg.id = 'game_div_tournament_bg';
            this.game_div_tournament_bg.classList.add("tournament_sprite_game","tournamentBtn_mouseout");
            this.game_div_tournament_btn.appendChild(this.game_div_tournament_bg);

            this.game_div_tournament_label = document.createElement('div');
            this.game_div_tournament_label.id = 'game_div_tournament_label';
            this.game_div_tournament_label.innerHTML = "<?php echo BTN_TOURNAMENT_LABEL ?>";
            this.game_div_tournament_btn.appendChild(this.game_div_tournament_label);

            this.game_div_tournament_btn.onclick = function(e){
                _tournamentGame.doTouchHandler({type:'click',currentTarget:_tournamentGame.game_div_tournament_btn});
            };
            this.game_div_tournament_btn.addEventListener("mouseover", function(e) {   
                _tournamentGame.doTouchHandler({type:'mouseover',currentTarget:_tournamentGame.game_div_tournament_btn});
            });
            this.game_div_tournament_btn.addEventListener("mouseout", function(e) {   
                _tournamentGame.doTouchHandler({type:'mouseout',currentTarget:_tournamentGame.game_div_tournament_btn});
            });
        };
        this.windowResize = function(){
            this.windowWidth = Math.max(screen.width, screen.height) && document.documentElement.clientWidth ? Math.min(window.innerWidth, document.documentElement.clientWidth) : window.innerWidth ||
                    document.documentElement.clientWidth ||
                    document.getElementsByTagName('body')[0].clientWidth;

            this.windowHeight = Math.min(screen.width, screen.height) && document.documentElement.clientHeight ? Math.min(window.innerHeight, document.documentElement.clientHeight) : window.innerHeight ||
                    document.documentElement.clientHeight ||
                    document.getElementsByTagName('body')[0].clientHeight;
            console.log(this.windowWidth,':',_tournamentGame.dimensionWidth, '    ',this.windowHeight,':',_tournamentGame.dimensionHeight);
            console.log(this.windowWidth / _tournamentGame.dimensionWidth, this.windowHeight / _tournamentGame.dimensionHeight);
            this.scale = Math.min(this.windowWidth / _tournamentGame.dimensionWidth, this.windowHeight / _tournamentGame.dimensionHeight);
            
            console.log('SCALE:',this.scale);
            _tournamentGame.tournament_align_div.style.webkitTransform = "translate3d(-50%,-50%, 0px) rotate(0rad) rotateX(0rad) rotateY(0rad) scale(" + this.scale + "," + this.scale + ")";
            _tournamentGame.tournament_align_div.transform = "translate3d(-50%,-50%, 0px) rotate(0rad) rotateX(0rad) rotateY(0rad) scale(" + this.scale + "," + this.scale + ")";
            _tournamentGame.tournament_align_div.msTransform = "translate3d(-50%,-50%, 0px) rotate(0rad) rotateX(0rad) rotateY(0rad) scale(" + this.scale + "," + this.scale + ")";
            _tournamentGame.tournament_align_div.webkitTransform = "translate3d(-50%,-50%, 0px) rotate(0rad) rotateX(0rad) rotateY(0rad) scale(" + this.scale + "," + this.scale + ")";    
            
            _tournamentGame.game_div_main_container.style.webkitTransform = "translate3d(0px,0px, 0px) rotate(0rad) rotateX(0rad) rotateY(0rad) scale(" + this.scale + "," + this.scale + ")";
            _tournamentGame.game_div_main_container.transform = "translate3d(0px,0px, 0px) rotate(0rad) rotateX(0rad) rotateY(0rad) scale(" + this.scale + "," + this.scale + ")";
            _tournamentGame.game_div_main_container.msTransform = "translate3d(0px,0px, 0px) rotate(0rad) rotateX(0rad) rotateY(0rad) scale(" + this.scale + "," + this.scale + ")";
            _tournamentGame.game_div_main_container.webkitTransform = "translate3d(0px,0px, 0px) rotate(0rad) rotateX(0rad) rotateY(0rad) scale(" + this.scale + "," + this.scale + ")";    
            
            _tournamentGame.alignPositions = $("#tournament_align_div").position();
            
            _tournamentGame.game_div_main_container.style.top = parseInt(_tournamentGame.alignPositions.top) + 'px';
            _tournamentGame.game_div_main_container.style.left = parseInt(_tournamentGame.alignPositions.left) + 'px';
            console.log($("#tournament_align_div").position())
            
        },
        this.doTouchHandler = function(_params){
            console.log(_params);
            //clear all classlist
            while (_tournamentGame.game_div_tournament_bg.classList.length > 0) {
               _tournamentGame.game_div_tournament_bg.classList.remove(_tournamentGame.game_div_tournament_bg.classList.item(0));
            }
            switch(_params.type){
                case 'click':
                    console.log(_tournamentGame.tournamentDetails);
                    _tournamentGame.tournamentDetails.update({type:'SHOW_TOURNAMENT_DETAILS'});
                    _tournamentGame.game_div_tournament_bg.classList.add("tournament_sprite_game","tournamentBtn_mouseout");
                    break;
                case 'mouseover':
                    _tournamentGame.game_div_tournament_bg.classList.add("tournament_sprite_game","tournamentBtn_mouseover");
                    break;
                case 'mouseout':
                    _tournamentGame.game_div_tournament_bg.classList.add("tournament_sprite_game","tournamentBtn_mouseout");
                    break;
            }
        };
        
        this.update = function(_params){
            //console.log('TOURNAMENT GAME UPDATE:',_params);
            switch(_params.type){
                case 'GameInfo':
                    if(_params.data.UserEntry){
                        if(_params.data.UserEntry.Score){
                            this.game_div_info_score_value.innerHTML = _params.data.UserEntry.Score;
                        }else{
                            this.game_div_info_score_value.innerHTML = '0';
                        }
                        
                        if(_params.data.UserEntry.RemainingRounds){
                            this.game_div_info_round_value.innerHTML = _params.data.UserEntry.RemainingRounds;
                        }else{
                            this.game_div_info_round_value.innerHTML = '';
                        }
                    }
                    if(_params.data.RemainingTime){
                        this.game_div_info_timer_value.innerHTML = _params.data.RemainingTime;
                    }else{
                        this.game_div_info_timer_value.innerHTML = '';
                    }
                    
                    this.dimensionWidth = _params.dimensionWidth;
                    this.dimensionHeight = _params.dimensionHeight;
                    this.assetSize = _params.assetSize;
                    
                    this.tournametAssetsPath = decodeURIComponent(this.gameParams.tournamentAssetPath);
                    
                    console.log('TOURNAMENT GAMEINFO:',this.gameParams,this.tournametAssetsPath);
                    this.gameParams.gameID = parseInt(this.gameParams.gameID);
                    console.log('CHECK:',this.gameParams.gameID >= 991000 && this.gameParams.gameID <= 992999);
                    if(this.gameParams.gameID >= 99500 && this.gameParams.gameID <= 99999){
                        //SLOTS
                        if(parseInt(this.gameParams.channel) >= 5000 && parseInt(this.gameParams.channel) <= 5999){
                            //DW
                        }else if(parseInt(this.gameParams.channel) >= 6000 && parseInt(this.gameParams.channel) <= 6999){
                            //ALTIRA
                        }
                        
                        switch(this.assetSize){
                            case 'DESKTOP':
                                console.log('LOADING DESKTOP1');
                                loadTournamentCss(this.tournametAssetsPath + 'css/Slots_Desktop.css');    
                                break;
                            case 'TABLET':
                                console.log('LOADING DESKTOP2');
                                loadTournamentCss(this.tournametAssetsPath + 'css/Slots_Desktop.css');
                                break;
                            case 'MOBILE':
                                console.log('LOADING DESKTOP3');
                                loadTournamentCss(this.tournametAssetsPath + 'css/Slots_Mobile.css');
                                break;
                        }
                        loadTournamentCss(this.tournametAssetsPath + 'css/Slots_Assets.css');
                        
                        if(this.tournament_align_div){
                            this.tournament_align_div.classList.add('tournament_align_desktop');
                        }
                    }else if(this.gameParams.gameID >= 991000 && this.gameParams.gameID <= 992999){
                        console.log('LOADING TABLE GAMES TOURNAMENT:',this.assetSize);
                        //TABLEGAMES
                        if(parseInt(this.gameParams.channel) >= 5000 && parseInt(this.gameParams.channel) <= 5999){
                            //DW
                        }else if(parseInt(this.gameParams.channel) >= 6000 && parseInt(this.gameParams.channel) <= 6999){
                            //ALTIRA
                        }
                        switch(this.assetSize){
                            case 'DESKTOP':
                                console.log('LOADING TABLE GAMES CSS DESKTOP');
                                loadTournamentCss(this.tournametAssetsPath + 'css/TableGame_Desktop_Blackjack.css');    
                                break;
                            case 'TABLET':
                                console.log('LOADING TABLE GAMES CSS TABLET');
                                loadTournamentCss(this.tournametAssetsPath + 'css/TableGame_Desktop_Blackjack.css');
                                break;
                            case 'MOBILE':
                                console.log('LOADING TABLE GAMES CSS MOBILE');
                                loadTournamentCss(this.tournametAssetsPath + 'css/TableGame_Mobile_Blackjack.css');
                                break;
                        }
                        loadTournamentCss(this.tournametAssetsPath + 'css/Blackjack_Assets.css');
                    }
                    
                    
                    console.log(loadTournamentCss)
                    
                    window.addEventListener('resize', this.windowResize);
                    setTimeout(function(){
                        _tournamentGame.game_div_main_parent.append(_tournamentGame.game_div_main_container);
                        window.dispatchEvent(new Event('resize'));
                    },500);
                
                    if(this.tournament_align_div){
                        this.tournament_align_div.style.width = this.dimensionWidth + 'px';
                        this.tournament_align_div.style.height = this.dimensionHeight + 'px';
                    }
                    
                    //convert time to seconds
                    //console.log('REMAINING TIME:',_params.data.RemainingTime);
                    //_params.data.RemainingTime = '01 day 00:00:10';
                    //06 days 21:35:55
                    var remainingTime = _params.data.RemainingTime;
                    remainingTime = remainingTime.trim();
                    remainingTime = remainingTime.replace(/^\s+|\s+$/gm,'');
                    remainingTime = remainingTime.replace(/ /g,'');
                    //console.log('remainingTime trim:',remainingTime);
                    
                    //days to seconds
                    if(remainingTime.indexOf('days') > -1 || remainingTime.indexOf('day') > -1){
                        if(remainingTime.indexOf('days') > -1){
                            remainingTime = remainingTime.split('days');    
                        }
                        if(remainingTime.indexOf('day') > -1){
                            remainingTime = remainingTime.split('day');    
                        }
                        //console.log('remainingTime:',remainingTime);
                        
                        this.remainingTimeInSeconds += parseInt(remainingTime[0]) * 24 * 60 * 60;
                        //console.log('DAYS IN SECONDS:',this.remainingTimeInSeconds);
                    }
                    
                    //hh:mm:ss to seconds
                    //console.log('CHECK REMAINING FORMAT:',remainingTime);
                    if(Array.isArray(remainingTime)){
                        remainingTime = remainingTime[1];    
                    }
                    //console.log('REMAING HRS:',remainingTime);
                    remainingTime = remainingTime.split(':');
                    this.remainingTimeInSeconds += parseInt(remainingTime[0]) * 60 * 60;
                    this.remainingTimeInSeconds += parseInt(remainingTime[1]) * 60;
                    this.remainingTimeInSeconds += parseInt(remainingTime[2]);
                    //console.log('remainingTimeInSeconds:',this.remainingTimeInSeconds);
                    
                    //start timer
                    this.remainingTimeTimer = setInterval(function(){
                        _tournamentGame.update({type:'UPDATE_TIME'});
                    },1000);
                    break;
                case 'EOS':
                    if(_params.data){
                        this.game_div_info_score_value.innerHTML = _params.data;
                    }
                    break;
                case 'BET':
                    if(_params.data){
                        this.game_div_info_round_value.innerHTML = _params.data;
                    }
                    break;
                    
                case 'UPDATE_TIME':
                    this.remainingTimeInSeconds --;
                    this.remainingTime_temp = 0;
                    this.remainingTime_Days = 0;
                    this.remainingTime_Hours = 0;
                    this.remainingTime_Minutes = 0;
                    this.remainingTime_Seconds = 0;
                    
                    this.remainingTime_temp = this.remainingTimeInSeconds;
                    this.remainingTime_Days = parseInt(this.remainingTime_temp / (24 * 3600)); 
                    if(this.remainingTime_Days <= 9){
                        this.remainingTime_Days = '0'+this.remainingTime_Days;
                    }
                    
                    this.remainingTime_temp = this.remainingTime_temp % (24 * 3600); 
                    this.remainingTime_Hours = parseInt(this.remainingTime_temp / 3600); 
                    if(this.remainingTime_Hours <= 9){
                        this.remainingTime_Hours = '0'+this.remainingTime_Hours;
                    }

                    this.remainingTime_temp %= 3600; 
                    this.remainingTime_Minutes = parseInt(this.remainingTime_temp / 60); 
                    if(this.remainingTime_Minutes <= 9){
                        this.remainingTime_Minutes = '0'+this.remainingTime_Minutes;
                    }
                    
                    this.remainingTime_temp %= 60; 
                    this.remainingTime_Seconds = parseInt(this.remainingTime_temp); 
                    if(this.remainingTime_Seconds <= 9){
                        this.remainingTime_Seconds = '0'+this.remainingTime_Seconds;
                    }
                    // console.log(this.remainingTime_Days,this.remainingTime_Hours ,this.remainingTime_Minutes,this.remainingTime_Seconds);
                    
                    if(parseInt(this.remainingTime_Days) > 0){
                        this.remainingTime_Display = this.remainingTime_Days + ' days ' + this.remainingTime_Hours + ':' + this.remainingTime_Minutes + ':' + this.remainingTime_Seconds;
                    }else{
                        this.remainingTime_Display = this.remainingTime_Hours + ':' + this.remainingTime_Minutes + ':' + this.remainingTime_Seconds;
                    }
                    this.game_div_info_timer_value.innerHTML = this.remainingTime_Display;
                    _tournamentGame.tournamentDetails.update({type:_params.type,data:this.remainingTime_Display});
                    break;
                case 'MOVE_NEW_TOURNAMENT':
                    _tournamentGame.game_div_tournament_container.classList.add('game_div_new');
                    while (_tournamentGame.game_div_info_bg.classList.length > 0) {
                       _tournamentGame.game_div_info_bg.classList.remove(_tournamentGame.game_div_info_bg.classList.item(0));
                    }
                    _tournamentGame.game_div_info_bg.classList.add('game_background_div_new');
                    break;
                case 'MOVE_INITIAL_TOURNAMENT':
                    _tournamentGame.game_div_tournament_container.classList.add('game_div_initial');
                    
                    while (_tournamentGame.game_div_info_bg.classList.length > 0) {
                       _tournamentGame.game_div_info_bg.classList.remove(_tournamentGame.game_div_info_bg.classList.item(0));
                    }
                    _tournamentGame.game_div_info_bg.classList.add('game_background_div_initial');
                    break;
                case 'SHOW_DIM_TOURNAMENT':
                    while (_tournamentGame.game_div_tournament_bg.classList.length > 0) {
                       _tournamentGame.game_div_tournament_bg.classList.remove(_tournamentGame.game_div_tournament_bg.classList.item(0));
                    }
                    _tournamentGame.game_div_tournament_bg.classList.add("tournament_sprite_game","tournamentBtn_disabled");
                    _tournamentGame.game_div_tournament_container.style.pointerEvents = 'none';
                    _tournamentGame.game_div_tournament_container.style.opacity = 0.3;
                    break;
                case 'HIDE_DIM_TOURNAMENT':
                    while (_tournamentGame.game_div_tournament_bg.classList.length > 0) {
                       _tournamentGame.game_div_tournament_bg.classList.remove(_tournamentGame.game_div_tournament_bg.classList.item(0));
                    }
                    _tournamentGame.game_div_tournament_bg.classList.add("tournament_sprite_game","tournamentBtn_mouseout");
                    _tournamentGame.game_div_tournament_container.style.pointerEvents = '';
                    _tournamentGame.game_div_tournament_container.style.opacity = 1;
                    break;
            }
        }
    }
</script>