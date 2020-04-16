

<!DOCTYPE html>
<html>
	<script type="text/javascript">
		var _this ;

		//the div container where this will be added. for now just using document
		var slot_div_main_parent;

		var status_main_container;




		var username;

		//Tournament BTN
		//divs
		var slot_div_tournament_btn;
		var slot_div_tournament_bg;
		var slot_div_tournament_label;
		var styleFlag;

		// var translations = LanguagePack();

		var leadersArray = [
			{	rank: 1, playerName: 'asds', score: 100		, prize: 100},
			{	rank: 2, playerName: 'asds', score: 95		, prize: 100},
			{	rank: 3, playerName: 'test3', score: 90		, prize: 100},
			{	rank: 4, playerName: 'test4', score: 85		, prize: 100},
			{	rank: 5, playerName: 'test5', score: 80		, prize: 100},
			{	rank: 6, playerName: 'asds', score: 100		, prize: 100},
			{	rank: 7, playerName: 'asds', score: 95		, prize: 100},
			{	rank: 8, playerName: 'test3', score: 90		, prize: 100},
			{	rank: 9, playerName: 'test4', score: 85		, prize: 100},
			{	rank: 10, playerName: 'test4', score: 85		, prize: 100},
			];

		var _tournamentStatus;

		function TournamentStatusValue(_params, _gameInfo){
			this.remainingTimeTimer = null;

			console.log('TournamentStatusValue', _params, _gameInfo, _assetSize, _gameID);
			username = _params.contest.leaderboard.entry.playerName;
			_tournamentStatus = this;

			
			
			slots_div_tournament_status_gameLogo_image.src  = _logoPath;
			status_leftside_container.appendChild(slots_div_tournament_status_gameLogo);
			
			status_leftside_container.appendChild(slots_div_tournament_status_timeRamaining);
			slots_div_tournament_status_timeRamaining.innerHTML = "<?php echo TIMERAMAINING ?>";

			// if(_params.contest.remainingTime){
			// slots_div_tournament_status_timer.innerHTML = _params.contest.remainingTime;
			status_leftside_container.appendChild(slots_div_tournament_status_timer);
			// }


			

			status_leftside_container.appendChild(slots_div_tournament_status_timer_labelGroup);

			if(_params.contest.description){
				slots_div_tournament_status_header.innerHTML = _params.contest.description;
				status_leftside_container.appendChild(slots_div_tournament_status_header);
			}

			slots_div_tournament_status_gameTitle.innerHTML = "<?php echo GAME ?>"; 
			slots_div_tournament_status_gameTitle_value.innerHTML = "<?php echo GameName_99755 ?>"; 
			status_leftside_container.appendChild(slots_div_tournament_status_gameTitle_group);
			
			if(_params.contest.leaderboard.entry.playerName){
				slots_div_tournament_status_entry.innerHTML = "<?php echo ENTRY ?>";
				slots_div_tournament_status_entry_value.innerHTML = _params.contest.leaderboard.entry.playerName + '('+ _params.contest.totalEntries +')';

				status_leftside_container.appendChild(slots_div_tournament_status_entry_group);
			}
			
			if(_gameInfo.UserEntry.RemainingRounds && _params.contest.maxRounds){
				status_leftside_container.appendChild(slots_div_tournament_status_rounds_group);
				slots_div_tournament_status_rounds.innerHTML = "<?php echo ROUNDS ?>";
				slots_div_tournament_status_rounds_value.innerHTML =  _gameInfo.UserEntry.RemainingRounds + ' / ' + _params.contest.maxRounds;
			}
			
			if(_gameInfo.UserEntry.Score){
				status_leftside_container.appendChild(slots_div_tournament_status_currentScore_group);
				slots_div_tournament_status_currentScore.innerHTML = "<?php echo CURRENTSCORE ?>";
				slots_div_tournament_status_currentScore_value.innerHTML = _gameInfo.UserEntry.Score;
			}

			
			slots_div_tournament_status_currentRank.innerHTML = "<?php echo CURRENTRANK ?>"

			if(_params.contest.currentRank){
				slots_div_tournament_status_currentRank_value.innerHTML = _params.contest.rank;
				status_leftside_container.appendChild(slots_div_tournament_status_currentRank_group);
			}
			
			slots_div_tournament_status_currentPrize.innerHTML = "<?php echo CURRENTPRIZE ?>";

			if(_params.contest.currentPrize){
				slots_div_tournament_status_currentPrize_value.innerHTML = _params.contest.currentPrize;
				status_leftside_container.appendChild(slots_div_tournament_status_currentPrize_group);
			}

			
			status_rightside_container.appendChild(slots_div_tournament_status_leaders_div);
			slots_div_tournament_status_leaders_div.innerHTML = "<?php echo LEADERS ?>";

			status_rightside_container.appendChild(slots_div_tournament_status_table_div);


			
			

			this.update = function(_value){
				// console.log('STATUS_UPDATE', _value);
				switch(_value.type){
					
					case 'UPDATE_TIME':
						var remainingTime = _value.data;
						var _flag;
						var timeToDisplay = "";
						
						remainingTime = remainingTime.trim();
	                    remainingTime = remainingTime.replace(/^\s+|\s+$/gm,'');
	                    remainingTime = remainingTime.replace(/ /g,'');

						if(remainingTime.indexOf('days') > -1 || remainingTime.indexOf('day') > -1){
	                        if(remainingTime.indexOf('days') > -1){
	                            remainingTime = remainingTime.split('days');    
	                        }
	                        if(remainingTime.indexOf('day') > -1){
	                            remainingTime = remainingTime.split('day');    
	                        }
	                        _flag = remainingTime[1].split(':');
	                      
	                        remainingTime.pop();

	                        _flag.unshift(remainingTime[0]);

	                        remainingTime = _flag;

	                        // remainingTime[0] = "00";
	                        // remainingTime[1] = "00";
	                    }
	                    
	                    

                        console.log(remainingTime);

						slots_div_tournament_status_timer_label_seconds.innerHTML = "<?php echo SECONDS ?>";
						slots_div_tournament_status_timer_label_seconds.style.display = "block";

						slots_div_tournament_status_timer_label_minutes.innerHTML = "<?php echo MINUTES ?>";
						slots_div_tournament_status_timer_label_minutes.style.display = "block";

						slots_div_tournament_status_timer_label_hours.innerHTML = "<?php echo HOURS ?>";
						slots_div_tournament_status_timer_label_hours.style.display = "block";
						
						if(parseInt(remainingTime[0]) > 0){
	                    	slots_div_tournament_status_timer_label_days.innerHTML = "<?php echo DAYS ?>";
	                    	slots_div_tournament_status_timer_label_days.style.display = "block";
						}else{
							remainingTime.shift();
						}

						for (var a = 0; a < remainingTime.length; a++) {
	                    	if(a == remainingTime.length - 1){
	                    		timeToDisplay = timeToDisplay + remainingTime[a];
	                    	}else{
	                    		timeToDisplay = timeToDisplay + remainingTime[a] + ":";
	                    	}
	                    }

	                    slots_div_tournament_status_timer.innerHTML = timeToDisplay;

	                break;
	            }

			}
		}

		init_Status = function(){

			// status_container = document.getElementById('status_container');
			console.log('init_Status', status_container);
			status_main_container = document.createElement('div');
			status_main_container.id = 'status_main_container';
			status_container.appendChild(status_main_container);
			//main container

			status_leftside_container= document.createElement('div');
			status_leftside_container.id = 'status_leftside_container';
			status_main_container.appendChild(status_leftside_container);

			status_rightside_container= document.createElement('div');
			status_rightside_container.id = 'status_rightside_container';
			status_main_container.appendChild(status_rightside_container);

			slots_div_tournament_status_gameLogo = document.createElement('div');
			slots_div_tournament_status_gameLogo.id = 'slots_div_tournament_status_gameLogo';
			
			slots_div_tournament_status_gameLogo_image = document.createElement('img');
			slots_div_tournament_status_gameLogo_image.id = 'slots_div_tournament_status_gameLogo_image';
			slots_div_tournament_status_gameLogo.appendChild(slots_div_tournament_status_gameLogo_image);


			slots_div_tournament_status_header = document.createElement('div');
			slots_div_tournament_status_header.id = 'slots_div_tournament_status_header';

			slots_div_tournament_status_timeRamaining= document.createElement('div');
			slots_div_tournament_status_timeRamaining.id = 'slots_div_tournament_status_timeRamaining';		

			slots_div_tournament_status_timer = document.createElement('div');
			slots_div_tournament_status_timer.id = 'slots_div_tournament_status_timer';			
			
			slots_div_tournament_status_timer_labelGroup = document.createElement('div');
			slots_div_tournament_status_timer_labelGroup.id = 'slots_div_tournament_status_timer_labelGroup';

			slots_div_tournament_status_timer_label_days = document.createElement('div');
			slots_div_tournament_status_timer_label_days.id = 'slots_div_tournament_status_timer_label_days';
			slots_div_tournament_status_timer_label_days.style.display = "none";
			slots_div_tournament_status_timer_labelGroup.appendChild(slots_div_tournament_status_timer_label_days);

			slots_div_tournament_status_timer_label_hours = document.createElement('div');
			slots_div_tournament_status_timer_label_hours.id = 'slots_div_tournament_status_timer_label_hours';
			slots_div_tournament_status_timer_label_hours.style.display = "none";
			slots_div_tournament_status_timer_labelGroup.appendChild(slots_div_tournament_status_timer_label_hours);

			slots_div_tournament_status_timer_label_minutes = document.createElement('div');
			slots_div_tournament_status_timer_label_minutes.id = 'slots_div_tournament_status_timer_label_minutes';
			slots_div_tournament_status_timer_label_minutes.style.display = "none";
			slots_div_tournament_status_timer_labelGroup.appendChild(slots_div_tournament_status_timer_label_minutes);

			slots_div_tournament_status_timer_label_seconds = document.createElement('div');
			slots_div_tournament_status_timer_label_seconds.id = 'slots_div_tournament_status_timer_label_seconds';
			slots_div_tournament_status_timer_label_seconds.style.display = "none";
			slots_div_tournament_status_timer_labelGroup.appendChild(slots_div_tournament_status_timer_label_seconds);





			slots_div_tournament_status_gameTitle_group = document.createElement('div');
			slots_div_tournament_status_gameTitle_group.id = 'slots_div_tournament_status_gameTitle_group';	
			

			slots_div_tournament_status_gameTitle = document.createElement('div');
			slots_div_tournament_status_gameTitle.id = 'slots_div_tournament_status_gameTitle';	
			slots_div_tournament_status_gameTitle.classList.add("slots_div_tournament_status_Titles");
			slots_div_tournament_status_gameTitle_group.appendChild(slots_div_tournament_status_gameTitle);

			slots_div_tournament_status_gameTitle_value = document.createElement('div');
			slots_div_tournament_status_gameTitle_value.id = 'slots_div_tournament_status_gameTitle_value';	
			// slots_div_tournament_status_gameTitle_value.classList.add("slots_div_tournament_status_Values");
			slots_div_tournament_status_gameTitle_group.appendChild(slots_div_tournament_status_gameTitle_value);


			slots_div_tournament_status_entry_group = document.createElement('div');
			slots_div_tournament_status_entry_group.id = 'slots_div_tournament_status_entry_group';	
			slots_div_tournament_status_entry_group.classList.add("slots_div_tournament_status_Groups");

			slots_div_tournament_status_entry = document.createElement('div');
			slots_div_tournament_status_entry.id = 'slots_div_tournament_status_entry';
			slots_div_tournament_status_entry.classList.add("slots_div_tournament_status_Titles");
			slots_div_tournament_status_entry_group.appendChild(slots_div_tournament_status_entry);

			slots_div_tournament_status_entry_value = document.createElement('div');
			slots_div_tournament_status_entry_value.id = 'slots_div_tournament_status_entry_value';
			slots_div_tournament_status_entry_value.classList.add("slots_div_tournament_status_Values");
			slots_div_tournament_status_entry_group.appendChild(slots_div_tournament_status_entry_value);


			slots_div_tournament_status_rounds_group = document.createElement('div');
			slots_div_tournament_status_rounds_group.id = 'slots_div_tournament_status_rounds_group';
			slots_div_tournament_status_rounds_group.classList.add("slots_div_tournament_status_Groups");

			slots_div_tournament_status_rounds = document.createElement('div');
			slots_div_tournament_status_rounds.id = 'slots_div_tournament_status_rounds';	
			slots_div_tournament_status_rounds.classList.add("slots_div_tournament_status_Titles");
			slots_div_tournament_status_rounds_group.appendChild(slots_div_tournament_status_rounds);

			slots_div_tournament_status_rounds_value = document.createElement('div');
			slots_div_tournament_status_rounds_value.id = 'slots_div_tournament_status_rounds_value';	
			slots_div_tournament_status_rounds_value.classList.add("slots_div_tournament_status_Values");
			slots_div_tournament_status_rounds_group.appendChild(slots_div_tournament_status_rounds_value);

			slots_div_tournament_status_currentScore_group = document.createElement('div');
			slots_div_tournament_status_currentScore_group.id = 'slots_div_tournament_status_currentScore_group';
			slots_div_tournament_status_currentScore_group.classList.add("slots_div_tournament_status_Groups");

			slots_div_tournament_status_currentScore = document.createElement('div');
			slots_div_tournament_status_currentScore.id = 'slots_div_tournament_status_currentScore';
			slots_div_tournament_status_currentScore.classList.add("slots_div_tournament_status_Titles");
			slots_div_tournament_status_currentScore_group.appendChild(slots_div_tournament_status_currentScore);

			slots_div_tournament_status_currentScore_value = document.createElement('div');
			slots_div_tournament_status_currentScore_value.id = 'slots_div_tournament_status_currentScore_value';
			slots_div_tournament_status_currentScore_value.classList.add("slots_div_tournament_status_Values");
			slots_div_tournament_status_currentScore_group.appendChild(slots_div_tournament_status_currentScore_value);

			slots_div_tournament_status_currentRank_group = document.createElement('div');
			slots_div_tournament_status_currentRank_group.id = 'slots_div_tournament_status_currentRank_group';
			slots_div_tournament_status_currentRank_group.classList.add("slots_div_tournament_status_Groups");

			slots_div_tournament_status_currentRank = document.createElement('div');
			slots_div_tournament_status_currentRank.id = 'slots_div_tournament_status_currentRank';
			slots_div_tournament_status_currentRank.classList.add("slots_div_tournament_status_Titles");
			slots_div_tournament_status_currentRank_group.appendChild(slots_div_tournament_status_currentRank);

			slots_div_tournament_status_currentRank_value = document.createElement('div');
			slots_div_tournament_status_currentRank_value.id = 'slots_div_tournament_status_currentRank_value';
			slots_div_tournament_status_currentRank_value.classList.add("slots_div_tournament_status_Values");
			slots_div_tournament_status_currentRank_group.appendChild(slots_div_tournament_status_currentRank_value);

			slots_div_tournament_status_currentPrize_group = document.createElement('div');
			slots_div_tournament_status_currentPrize_group.id = 'slots_div_tournament_status_currentPrize_group';
			slots_div_tournament_status_currentPrize_group.classList.add("slots_div_tournament_status_Groups");

			slots_div_tournament_status_currentPrize = document.createElement('div');
			slots_div_tournament_status_currentPrize.id = 'slots_div_tournament_status_currentPrize';
			slots_div_tournament_status_currentPrize.classList.add("slots_div_tournament_status_Titles");
			slots_div_tournament_status_currentPrize_group.appendChild(slots_div_tournament_status_currentPrize);

			slots_div_tournament_status_currentPrize_value = document.createElement('div');
			slots_div_tournament_status_currentPrize_value.id = 'slots_div_tournament_status_currentPrize_value';
			slots_div_tournament_status_currentPrize_value.classList.add("slots_div_tournament_status_Values");
			slots_div_tournament_status_currentPrize_group.appendChild(slots_div_tournament_status_currentPrize_value);
			

			slots_div_tournament_status_leaders_div= document.createElement('div');
			slots_div_tournament_status_leaders_div.id = 'slots_div_tournament_status_leaders_div';

			slots_div_tournament_status_table_div = document.createElement('div');
			slots_div_tournament_status_table_div.id = 'slots_div_tournament_status_table_div';

			slots_div_tournament_status_leaders = document.createElement('table');
			slots_div_tournament_status_leaders.id = 'slots_div_tournament_status_leaders';
			slots_div_tournament_status_table_div.appendChild(slots_div_tournament_status_leaders);

			slots_div_tournament_status_leaders_thead = document.createElement('thead');
			slots_div_tournament_status_leaders_thead.id = 'slots_div_tournament_status_leaders_thead';
			slots_div_tournament_status_leaders.appendChild(slots_div_tournament_status_leaders_thead);

			slots_div_tournament_status_leaders_header = document.createElement('tr');
			slots_div_tournament_status_leaders_header.id = 'slots_div_tournament_status_leaders_header';
			slots_div_tournament_status_leaders_thead.appendChild(slots_div_tournament_status_leaders_header);

			slots_div_tournament_status_leaders_rank = document.createElement('th');
			slots_div_tournament_status_leaders_rank.id = 'slots_div_tournament_status_leaders_rank';
			slots_div_tournament_status_leaders_rank.innerHTML = "<?php echo RANK ?>";
			// slots_div_tournament_status_leaders_rank.classList.add("slots_div_tournament_status_leaders_header");
			slots_div_tournament_status_leaders_header.appendChild(slots_div_tournament_status_leaders_rank);

			slots_div_tournament_status_leaders_name = document.createElement('th');
			slots_div_tournament_status_leaders_name.id = 'slots_div_tournament_status_leaders_name';
			slots_div_tournament_status_leaders_name.innerHTML = "<?php echo NAME ?>";
			// slots_div_tournament_status_leaders_name.classList.add("slots_div_tournament_status_leaders_header");
			slots_div_tournament_status_leaders_header.appendChild(slots_div_tournament_status_leaders_name);

			slots_div_tournament_status_leaders_score = document.createElement('th');
			slots_div_tournament_status_leaders_score.id = 'slots_div_tournament_status_leaders_score';
			slots_div_tournament_status_leaders_score.innerHTML = "<?php echo SCORES ?>";
			// slots_div_tournament_status_leaders_score.classList.add("slots_div_tournament_status_leaders_header");
			slots_div_tournament_status_leaders_header.appendChild(slots_div_tournament_status_leaders_score);

			slots_div_tournament_status_leaders_prize = document.createElement('th');
			slots_div_tournament_status_leaders_prize.id = 'slots_div_tournament_status_leaders_prize';
			slots_div_tournament_status_leaders_prize.innerHTML = "<?php echo PRIZE ?>";
			// slots_div_tournament_status_leaders_prize.classList.add("slots_div_tournament_status_leaders_header");
			slots_div_tournament_status_leaders_header.appendChild(slots_div_tournament_status_leaders_prize);

			
			slots_div_tournament_status_leaders_body = document.createElement('tbody');
			slots_div_tournament_status_leaders_body.id = 'slots_div_tournament_status_leaders_body';
			slots_div_tournament_status_leaders.appendChild(slots_div_tournament_status_leaders_body);


			for (var i = 0; i < leadersArray.length; i++) {
				var cssStyle = "";

				if(leadersArray[i].playerName == username){
					cssStyle = "slots_div_tournament_status_leaders_highlight";
				}else{
					if(i%2 == 0){
						cssStyle = "slots_div_tournament_status_leaders_col";
					}else{
						cssStyle = "slots_div_tournament_status_leaders_col2";
					}
					
				}

				slots_div_tournament_status_leaders_divider= document.createElement('tr');
				slots_div_tournament_status_leaders_divider.id = 'slots_div_tournament_status_leaders_divider';
				slots_div_tournament_status_leaders_body.appendChild(slots_div_tournament_status_leaders_divider);

				slots_div_tournament_status_leaders_rank_value = document.createElement('td');
				slots_div_tournament_status_leaders_rank_value.id = 'slots_div_tournament_status_leaders_rank_value';
				
				slots_div_tournament_status_leaders_rank_value.classList.add(cssStyle);
				slots_div_tournament_status_leaders_divider.appendChild(slots_div_tournament_status_leaders_rank_value);
				if(leadersArray[i].rank){
					slots_div_tournament_status_leaders_rank_value.innerHTML = leadersArray[i].rank;
				}else{
					slots_div_tournament_status_leaders_rank_value.innerHTML = "--";
				}


				slots_div_tournament_status_leaders_name_value = document.createElement('td');
				slots_div_tournament_status_leaders_name_value.id = 'slots_div_tournament_status_leaders_name_value';
				slots_div_tournament_status_leaders_name_value.innerHTML = leadersArray[i].playerName;
				slots_div_tournament_status_leaders_name_value.classList.add(cssStyle);
				slots_div_tournament_status_leaders_divider.appendChild(slots_div_tournament_status_leaders_name_value);

				slots_div_tournament_status_leaders_score_value = document.createElement('td');
				slots_div_tournament_status_leaders_score_value.id = 'slots_div_tournament_status_leaders_score_value';
				slots_div_tournament_status_leaders_score_value.innerHTML = leadersArray[i].score;
				slots_div_tournament_status_leaders_score_value.classList.add(cssStyle);
				slots_div_tournament_status_leaders_divider.appendChild(slots_div_tournament_status_leaders_score_value);
				
				slots_div_tournament_status_leaders_prize_value = document.createElement('td');
				slots_div_tournament_status_leaders_prize_value.id = 'slots_div_tournament_status_leaders_prize_value';
				slots_div_tournament_status_leaders_prize_value.innerHTML = leadersArray[i].prize;
				slots_div_tournament_status_leaders_prize_value.classList.add(cssStyle);
				slots_div_tournament_status_leaders_divider.appendChild(slots_div_tournament_status_leaders_prize_value);	
				if(leadersArray[i].prize){
					slots_div_tournament_status_leaders_prize_value.innerHTML = leadersArray[i].prize;
				}else{
					slots_div_tournament_status_leaders_prize_value.innerHTML = "--";
				}


			}
			
		};

		


	</script>
	<body>
	</body>
</html>