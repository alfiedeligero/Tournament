<?php
//this will server as the languagePack
define("SCORE", "SCORE:");
define("TIMER", "TIMER:");
define("ROUND_REMAINING", "ROUND REMAINING:");
define("BTN_TOURNAMENT_LABEL", "TOURNAMENT");
?>

<!DOCTYPE html>
<html>
	<body>
	</body>
</html>

<script type="text/javascript">
	/*//load CSS
	loadCss = function(_filename) {
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
        //loadCss('css/Slots_Mobile.css');
        loadCss('css/Slots_Desktop.css');
        loadCss('css/Slots_Assets.css');

        var _tournamentGame = this;
        
        //the div container where this will be added. for now just using document
        this.slot_div_main_parent = document.body;

        var slot_div_main_container;

        //info
        //divs
        var slot_div_info_container;
        var slot_div_info_bg;
        var slot_div_info_content_container;

        var slot_div_info_score_container;
        var slot_div_info_score_label;
        var slot_div_info_score_value;

        var slot_div_info_round_container;
        var slot_div_info_round_label;
        var slot_div_info_round_value;

        var slot_div_info_timer_container;
        var slot_div_info_timer_label;
        var slot_div_info_timer_value;

        //values
        var slotCurrentScore = '99,999.99';
        var slotCurrentTime = '99:99:99';
        var slotCurrentRound = '99/100';


        //Tournament BTN
        //divs
        var slot_div_tournament_btn;
        var slot_div_tournament_bg;
        var slot_div_tournament_label;



        init = function(){
            //main container
            slot_div_main_container = document.createElement('div');
            slot_div_main_container.id = 'slot_div_main_container';
            slot_div_main_parent.append(slot_div_main_container);

            //info contents
            slot_div_info_container = document.createElement('div');
            slot_div_info_container.id = 'slot_div_info_container';
            slot_div_main_container.appendChild(slot_div_info_container);

            //bg
            slot_div_info_bg = document.createElement('div');
            slot_div_info_bg.id = 'slot_div_info_bg';
            slot_div_info_container.appendChild(slot_div_info_bg);

            //content
            slot_div_info_content_container = document.createElement('div');
            slot_div_info_content_container.id = 'slot_div_info_content_container';
            slot_div_info_container.appendChild(slot_div_info_content_container);

            //score
            slot_div_info_score_container = document.createElement('div');
            slot_div_info_score_container.id = 'slot_div_info_score_container';
            slot_div_info_content_container.appendChild(slot_div_info_score_container);

            slot_div_info_score_label = document.createElement('div');
            slot_div_info_score_label.id = 'slot_div_info_score_label';
            slot_div_info_score_label.innerHTML = "<?php echo SCORE ?>";
            slot_div_info_score_container.appendChild(slot_div_info_score_label);

            slot_div_info_score_value = document.createElement('div');
            slot_div_info_score_value.id = 'slot_div_info_score_value';
            slot_div_info_score_value.innerHTML = slotCurrentScore;
            slot_div_info_score_container.appendChild(slot_div_info_score_value);


            //round
            slot_div_info_round_container = document.createElement('div');
            slot_div_info_round_container.id = 'slot_div_info_round_container';
            slot_div_info_content_container.appendChild(slot_div_info_round_container);

            slot_div_info_round_label = document.createElement('div');
            slot_div_info_round_label.id = 'slot_div_info_round_label';
            slot_div_info_round_label.innerHTML = "<?php echo ROUND_REMAINING ?>";
            slot_div_info_round_container.appendChild(slot_div_info_round_label);

            slot_div_info_round_value = document.createElement('div');
            slot_div_info_round_value.id = 'slot_div_info_round_value';
            slot_div_info_round_value.innerHTML = slotCurrentRound;
            slot_div_info_round_container.appendChild(slot_div_info_round_value);


            //timer
            slot_div_info_timer_container = document.createElement('div');
            slot_div_info_timer_container.id = 'slot_div_info_timer_container';
            slot_div_info_content_container.appendChild(slot_div_info_timer_container);

            slot_div_info_timer_label = document.createElement('div');
            slot_div_info_timer_label.id = 'slot_div_info_timer_label';
            slot_div_info_timer_label.innerHTML = "<?php echo TIMER ?>";
            slot_div_info_timer_container.appendChild(slot_div_info_timer_label);

            slot_div_info_timer_value = document.createElement('div');
            slot_div_info_timer_value.id = 'slot_div_info_timer_value';
            slot_div_info_timer_value.innerHTML = slotCurrentTime;
            slot_div_info_timer_container.appendChild(slot_div_info_timer_value);


            //tournament button
            slot_div_tournament_btn = document.createElement('div');
            slot_div_tournament_btn.id = 'slot_div_tournament_btn';
            slot_div_main_container.appendChild(slot_div_tournament_btn);

            slot_div_tournament_bg = document.createElement('div');
            slot_div_tournament_bg.id = 'slot_div_tournament_bg';
            slot_div_tournament_bg.classList.add("sprite_slots","tournamentBtn_mouseout");
            slot_div_tournament_btn.appendChild(slot_div_tournament_bg);

            slot_div_tournament_label = document.createElement('div');
            slot_div_tournament_label.id = 'slot_div_tournament_label';
            slot_div_tournament_label.innerHTML = "<?php echo BTN_TOURNAMENT_LABEL ?>";
            slot_div_tournament_btn.appendChild(slot_div_tournament_label);

            slot_div_tournament_btn.onclick = function(e){
                _this.doTouchHandler({type:'click',currentTarget:slot_div_tournament_btn});
            };
            slot_div_tournament_btn.addEventListener("mouseover", function(e) {   
                _this.doTouchHandler({type:'mouseover',currentTarget:slot_div_tournament_btn});
            });
            slot_div_tournament_btn.addEventListener("mouseout", function(e) {   
                _this.doTouchHandler({type:'mouseout',currentTarget:slot_div_tournament_btn});
            });
        };

        doTouchHandler = function(_params){
            console.log(_params);
            //clear all classlist
            while (slot_div_tournament_bg.classList.length > 0) {
               slot_div_tournament_bg.classList.remove(slot_div_tournament_bg.classList.item(0));
            }
            switch(_params.type){
                case 'click':
                    slot_div_tournament_bg.classList.add("sprite_slots","tournamentBtn_mouseout");
                    break;
                case 'mouseover':
                    slot_div_tournament_bg.classList.add("sprite_slots","tournamentBtn_mouseover");
                    break;
                case 'mouseout':
                    slot_div_tournament_bg.classList.add("sprite_slots","tournamentBtn_mouseout");
                    break;
            }
        };
    }
</script>

return;
<script>
    return;
	//loadCss('css/Slots_Mobile.css');
    loadCss('css/Slots_Desktop.css');
    loadCss('css/Slots_Assets.css');
    
    var _this = this;
	
	//the div container where this will be added. for now just using document
    this.slot_div_main_parent = document.body;
	
	this.slot_div_main_container;
	
	//info
    //divs
	var slot_div_info_container;
	var slot_div_info_bg;
    var slot_div_info_content_container;
	
	var slot_div_info_score_container;
	var slot_div_info_score_label;
	var slot_div_info_score_value;
	
	var slot_div_info_round_container;
	var slot_div_info_round_label;
	var slot_div_info_round_value;
	
	var slot_div_info_timer_container;
	var slot_div_info_timer_label;
	var slot_div_info_timer_value;
	
    //values
    var slotCurrentScore = '99,999.99';
    var slotCurrentTime = '99:99:99';
    var slotCurrentRound = '99/100';
    
    
    //Tournament BTN
    //divs
	var slot_div_tournament_btn;
	var slot_div_tournament_bg;
    var slot_div_tournament_label;
    
	
	
	init = function(){
		//main container
		this.slot_div_main_container = document.createElement('div');
		this.slot_div_main_container.id = 'slot_div_main_container';
		slot_div_main_parent.append(this.slot_div_main_container);
		
		//info contents
        slot_div_info_container = document.createElement('div');
		slot_div_info_container.id = 'slot_div_info_container';
		this.slot_div_main_container.appendChild(slot_div_info_container);
		
		//bg
		slot_div_info_bg = document.createElement('div');
		slot_div_info_bg.id = 'slot_div_info_bg';
		slot_div_info_container.appendChild(slot_div_info_bg);
        
        //content
        slot_div_info_content_container = document.createElement('div');
		slot_div_info_content_container.id = 'slot_div_info_content_container';
		slot_div_info_container.appendChild(slot_div_info_content_container);
        
        //score
        slot_div_info_score_container = document.createElement('div');
		slot_div_info_score_container.id = 'slot_div_info_score_container';
		slot_div_info_content_container.appendChild(slot_div_info_score_container);
        
        slot_div_info_score_label = document.createElement('div');
		slot_div_info_score_label.id = 'slot_div_info_score_label';
        slot_div_info_score_label.innerHTML = "<?php echo SCORE ?>";
		slot_div_info_score_container.appendChild(slot_div_info_score_label);
        
        slot_div_info_score_value = document.createElement('div');
		slot_div_info_score_value.id = 'slot_div_info_score_value';
        slot_div_info_score_value.innerHTML = slotCurrentScore;
		slot_div_info_score_container.appendChild(slot_div_info_score_value);
        
        
        //round
        slot_div_info_round_container = document.createElement('div');
		slot_div_info_round_container.id = 'slot_div_info_round_container';
		slot_div_info_content_container.appendChild(slot_div_info_round_container);
        
        slot_div_info_round_label = document.createElement('div');
		slot_div_info_round_label.id = 'slot_div_info_round_label';
        slot_div_info_round_label.innerHTML = "<?php echo ROUND_REMAINING ?>";
		slot_div_info_round_container.appendChild(slot_div_info_round_label);
        
        slot_div_info_round_value = document.createElement('div');
		slot_div_info_round_value.id = 'slot_div_info_round_value';
        slot_div_info_round_value.innerHTML = slotCurrentRound;
		slot_div_info_round_container.appendChild(slot_div_info_round_value);
        
        
        //timer
        slot_div_info_timer_container = document.createElement('div');
		slot_div_info_timer_container.id = 'slot_div_info_timer_container';
		slot_div_info_content_container.appendChild(slot_div_info_timer_container);
        
        slot_div_info_timer_label = document.createElement('div');
		slot_div_info_timer_label.id = 'slot_div_info_timer_label';
        slot_div_info_timer_label.innerHTML = "<?php echo TIMER ?>";
		slot_div_info_timer_container.appendChild(slot_div_info_timer_label);
        
        slot_div_info_timer_value = document.createElement('div');
		slot_div_info_timer_value.id = 'slot_div_info_timer_value';
        slot_div_info_timer_value.innerHTML = slotCurrentTime;
		slot_div_info_timer_container.appendChild(slot_div_info_timer_value);
        
        
        //tournament button
        slot_div_tournament_btn = document.createElement('div');
		slot_div_tournament_btn.id = 'slot_div_tournament_btn';
		this.slot_div_main_container.appendChild(slot_div_tournament_btn);
        
        slot_div_tournament_bg = document.createElement('div');
		slot_div_tournament_bg.id = 'slot_div_tournament_bg';
        slot_div_tournament_bg.classList.add("sprite_slots","tournamentBtn_mouseout");
		slot_div_tournament_btn.appendChild(slot_div_tournament_bg);
        
        slot_div_tournament_label = document.createElement('div');
		slot_div_tournament_label.id = 'slot_div_tournament_label';
        slot_div_tournament_label.innerHTML = "<?php echo BTN_TOURNAMENT_LABEL ?>";
		slot_div_tournament_btn.appendChild(slot_div_tournament_label);
        
        slot_div_tournament_btn.onclick = function(e){
            _this.doTouchHandler({type:'click',currentTarget:slot_div_tournament_btn});
        };
        slot_div_tournament_btn.addEventListener("mouseover", function(e) {   
            _this.doTouchHandler({type:'mouseover',currentTarget:slot_div_tournament_btn});
        });
        slot_div_tournament_btn.addEventListener("mouseout", function(e) {   
            _this.doTouchHandler({type:'mouseout',currentTarget:slot_div_tournament_btn});
        });
	};
    
    doTouchHandler = function(_params){
        console.log(_params);
        //clear all classlist
        while (slot_div_tournament_bg.classList.length > 0) {
           slot_div_tournament_bg.classList.remove(slot_div_tournament_bg.classList.item(0));
        }
        switch(_params.type){
            case 'click':
                slot_div_tournament_bg.classList.add("sprite_slots","tournamentBtn_mouseout");
                break;
            case 'mouseover':
                slot_div_tournament_bg.classList.add("sprite_slots","tournamentBtn_mouseover");
                break;
            case 'mouseout':
                slot_div_tournament_bg.classList.add("sprite_slots","tournamentBtn_mouseout");
                break;
        }
    };
	
	document.onreadystatechange = function () {
        if (document.readyState === 'complete') {
			//init();
            
            /*ANIMATE CSS*/
            /*
            slot_div_main_container.classList.add('slot_div_hide');
            setInterval(function(){
                if(slot_div_main_container.classList.contains('slot_div_hide')){
                    slot_div_main_container.classList.remove('slot_div_hide');
                    slot_div_main_container.classList.add('slot_div_show');
                }else{
                    slot_div_main_container.classList.remove('slot_div_show');
                    slot_div_main_container.classList.add('slot_div_hide');
                }   
            },3000);
            */
     	}
	}
</script>