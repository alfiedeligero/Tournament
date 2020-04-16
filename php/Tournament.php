<?php include $_GET['tournamentPath'].'php/Game.php' ?>
<?php include $_GET['tournamentPath'].'php/tournamentDetails.php' ?>

<script>
    //var tournametAssetsPath = '../../../../../../Tournament/';
    
    //loadTournamentCss(tournametAssetsPath + 'css/Tournament.css');
    
    /*loadCss = function(){
        fileref = document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", assetsGamePath + cssForLoading);
        document.getElementsByTagName("head")[0].appendChild(fileref);   
    }*/
    
    loadTournamentCss = function(_file){
        fileref = document.createElement("link");
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", _file);
        document.getElementsByTagName("head")[0].appendChild(fileref);
    }
    
    function Tournament(_params){
        console.log('TOURNAMENT INITIALIZE:',_params);
        this.gameParams = _params;
        this.tournametAssetsPath = decodeURIComponent(_params.tournamentAssetPath);
        this.tournament_container_div;
        
        console.log('DECODED:',this.tournametAssetsPath);
        
        
        
        
        this.init = function(){
            //check game.
            console.log('CSS PATH:',this.tournametAssetsPath + 'css/Tournament.css');
            loadTournamentCss(this.tournametAssetsPath + 'css/Tournament.css');
            
            if(document.getElementById('game')){
                this.tournament_parent_div = document.getElementById('game');
            }else if(document.getElementById('canvasWrapper')){
                this.tournament_parent_div = document.getElementById('canvasWrapper');    
            }else{
                this.tournament_parent_div = document.body;
            }
            console.log('PARENT DIV:',this.tournament_parent_div);
            
            
            this.tournament_container_div = document.createElement('div');
            this.tournament_container_div.id = 'tournament_container_div';
            this.tournament_parent_div.append(this.tournament_container_div);  
            
            this.tournament_align_div = document.createElement('div');
            this.tournament_align_div.id = 'tournament_align_div';
            this.tournament_parent_div.append(this.tournament_align_div);
            
            this.tournament_details_container_div = document.createElement('div');
            this.tournament_details_container_div.id = 'tournament_details_container_div';
            this.tournament_parent_div.append(this.tournament_details_container_div);
            
            this.tournamentDetails = new TournamentDetails(this.gameParams);
            this.tournamentGame = new TournamentGame(this.gameParams);
            
            this.tournamentGame.init({parent:this.tournament_container_div,
                                      align_div: this.tournament_align_div,
                                      tournamentDetails: this.tournamentDetails,
                                      tournament_details_container_div: this.tournament_details_container_div
                                     });
            this.tournamentDetails.init({parent:this.tournament_details_container_div,
                                         tournamentGame: this.tournamentGame,
                                         tournametAssetsPath: this.tournametAssetsPath
                                        });
            
        };
        
        this.update = function(_params){
            //console.log('TOURNAMENT UPDATE:',_params);
            
            switch(_params.type){
                case 'GameInfo':
                    this.init();
                    
                    this.tournamentGame.update(_params);
                    this.tournamentDetails.update(_params);
                    break;
                case 'EOS':
                    this.tournamentGame.update(_params);
                    this.tournamentDetails.update(_params);
                    break;
                case 'BET':
                    this.tournamentGame.update(_params);
                    this.tournamentDetails.update(_params);
                    break;
                case 'GetTournamentDetails':
                    this.tournamentDetails.update(_params);
                    break;
                case 'HIDE_TOURNAMENT':
                    this.tournament_container_div.style.display = 'none';
                    break;
                case 'SHOW_TOURNAMENT':
                    this.tournament_container_div.style.display = 'block';
                    break;
                case 'MOVE_NEW_TOURNAMENT':
                    this.tournamentGame.update(_params);
                    break;
                case 'MOVE_INITIAL_TOURNAMENT':
                    this.tournamentGame.update(_params);
                    break;
                case 'SHOW_DIM_TOURNAMENT':
                    this.tournamentGame.update(_params);
                    break;
                case 'HIDE_DIM_TOURNAMENT':
                    this.tournamentGame.update(_params);
                    break;
            }
        };
        
        //this.init();
    }
    //var tournament = new Tournament();
	
</script>
