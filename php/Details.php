

<!DOCTYPE html>
<html>
<script type="text/javascript">
	var tournamentName;
	var remainingTime;
	var entryFee;
	var startEndTime;
	var gameTitle;
	var nameOfEntrant;
	var prizeListing;
	var details_container;
	var remainingTime;
	var maxRounds;
	var ties;
	var _tournamentDetails;

	function TournamentDetailsValue(_params){
		console.log('TournamentDetailsValue', _params);
		console.log('this.tournametAssetsPath====')

		_tournamentDetails = this;
		// gameLogo.innerHTML = "LOGO";

		gameLogoImg.src = "<?php echo GAME_LOGO ?>";

		gameTitle.innerHTML = "<?php echo GAME ?>" +"<?php echo GAME_TITLE ?>";

		if(_params.contest.description){
			tournamentName.innerHTML = _params.contest.description;
		}else{
			tournamentName.style.display = 'none';
		}
		if(_params.contest.remainingTime){
			remainingTime.innerHTML = "<?php echo TIMELIMIT ?>"+_params.contest.remainingTime;
		}else{
			remainingTime.style.display = 'none';
		}
		if( _params.contest.entryFee){
			entryFee.innerHTML = "<?php echo ENTRYFEE ?>" + _params.contest.entryFee;
		}else{
			entryFee.style.display = 'none';
		}
		if(_params.contest.maxRounds){
			maxRounds.innerHTML = "<?php echo MAXROUNDS ?>" + _params.contest.maxRounds;
		}else{
			maxRounds.style.display = 'none';
		}
		if(_params.contest.startDate){
			startEndTime.innerHTML = "<?php echo START ?>" + _params.contest.startDate;
		}else{
			startEndTime.style.display = 'none';
		}		
		if( _params.contest.leaderboard.entry.playerName){
			nameOfEntrant.innerHTML = _params.contest.leaderboard.entry.playerName;
		}else{
			nameOfEntrant.style.display = 'none';
		}

		//added details//
		if(_params.contest.endDate){
			endDate.innerHTML = "<?php echo END ?>" +_params.contest.endDate;
		}else{
			endDate.style.display = 'none';
		}
		if(_params.contest.ties){
			ties.innerHTML = "<?php echo TIES ?>" +_params.contest.ties;
		}else{
			ties.style.display = 'none';
		}
		if(_params.contest.entriesPerCostumer){
			entriesPerCostumer.innerHTML = "<?php echo ENTRIESPERCOSTUMER ?>" +_params.contest.entriesPerCostumer;
		}else{
			entriesPerCostumer.style.display = 'none';
		}
		if(_params.contest.maxEntries){
			maxEntries.innerHTML = "<?php echo MAXENTRIES ?>" +_params.contest.maxEntries;
		}else{
			maxEntries.style.display = 'none'
		}
		


		// prizeListing.innerHTML = _params.contest.prizes;

		/*// console.log( document.getElementById("prizeListingTable").rows.length);
		for (var x = document.getElementById("prizeListingTable").rows.length - 1; x > 0; x--) {
			document.getElementById("prizeListingTable").deleteRow(0)
		}*/
		for (var i = 0; i < _params.contest.prizes.item.length; i++) {
			
			// console.log('-------------', _params.contest.prizes.item.length);
			prizeListingTableBodyTR= document.createElement('tr');
			prizeListingTableBodyTR.id = 'prizeListingTableBodyTR';
			prizeListingTableBody.appendChild(prizeListingTableBodyTR);

			prizeListingTableBodyRank = document.createElement('td');
			prizeListingTableBodyRank.id = 'prizeListingTableBodyRank';
			prizeListingTableBodyRank.classList.add("prizeListingTableBodyItems");
			prizeListingTableBodyRank.innerHTML = _params.contest.prizes.item[i].rank;
			prizeListingTableBodyTR.appendChild(prizeListingTableBodyRank);

			prizeListingTableBodyValue = document.createElement('td');
			prizeListingTableBodyValue.id = 'prizeListingTableBodyValue';
			prizeListingTableBodyValue.classList.add("prizeListingTableBodyItems");
			prizeListingTableBodyValue.innerHTML = _params.contest.prizes.item[i].value;
			// slots_div_tournament_status_name_value.classList.add(cssStyle);
			prizeListingTableBodyTR.appendChild(prizeListingTableBodyValue);

			if((i%2) ==0){
				prizeListingTableBodyRank.style.background = '#1b191b';
				prizeListingTableBodyValue.style.background = '#1b191b';
			}else{
				prizeListingTableBodyRank.style.background = '#5c5a5c';
				prizeListingTableBodyValue.style.background = '#5c5a5c';
			}


		}
		
		
	};
	timerUpdate = function(_value){
			// console.log('details_UPDATE', _value);
			switch(_value.type){
				case 'UPDATE_TIME':
				if(remainingTime){
					remainingTime.innerHTML = "<?php echo TIMELIMIT ?>"+_value.data;
				}
				break;
			}
	};
	init_Details = function(){
		// details_container = document.getElementById("details_container");

		console.log('INIT DETAILS');

		details_main_container = document.createElement('div');
		details_main_container.id = 'details_main_container';
		details_container.appendChild(details_main_container);

		details_leftside_container = document.createElement('div');
		details_leftside_container.id = 'details_leftside_container';
		details_leftside_container.classList.add("details_leftside_container");
		details_main_container.appendChild(details_leftside_container);
		
		details_rightside_container = document.createElement('div');
		details_rightside_container.id = 'details_rightside_container';
		details_rightside_container.classList.add("details_rightside_container");
		details_main_container.appendChild(details_rightside_container);

		

		gameLogoContainer = document.createElement('div');
		gameLogoContainer.id = 'gameLogoContainer';
		gameLogoContainer.classList.add("gameLogoContainer");
		details_leftside_container.appendChild(gameLogoContainer);

		gameLogo = document.createElement('div');
		gameLogo.id = 'gameLogo';
		gameLogo.classList.add("gameLogo");
		gameLogoContainer.appendChild(gameLogo);

		gameLogoImg = document.createElement('img');
		
		// gameLogoImg.src = 'http://localhost/Pacifica/Tournament/res/Images/logo.png'
		gameLogo.appendChild(gameLogoImg);

		tournamentName = document.createElement('div');
		tournamentName.id = 'tournamentName';
		tournamentName.classList.add("tournamentName");
		details_leftside_container.appendChild(tournamentName);

		gameTitle = document.createElement('div');
		gameTitle.id = 'gameTitle';
		gameTitle.classList.add("details_content");
		// gameTitle.innerHTML = "<?php echo GAMETITLE ?>";
		details_leftside_container.appendChild(gameTitle);

		remainingTime = document.createElement('div');
		remainingTime.id = 'remainingTime';
		remainingTime.classList.add("details_content");
		// timerDetails.innerHTML = "<?php echo TIMER ?>";
		details_leftside_container.appendChild(remainingTime); 

		entryFee = document.createElement('div');
		entryFee.id = 'entryFee';
		entryFee.classList.add("details_content");
		// entryFee.innerHTML = "<?php echo ENTRYFEE ?>" + '9999';
		details_leftside_container.appendChild(entryFee); 

		maxRounds = document.createElement('div');
		maxRounds.id = 'maxRounds';
		maxRounds.classList.add("details_content");
		details_leftside_container.appendChild(maxRounds); 

		startEndTime = document.createElement('div');
		startEndTime.id = 'startEndTime';
		startEndTime.classList.add("details_content");
		// startEndTime.innerHTML = 'Start date/ time , End date/time';
		details_leftside_container.appendChild(startEndTime);


//added details//
endDate = document.createElement('div');
endDate.id = 'startEndTime';
endDate.classList.add("details_content");
		// startEndTime.innerHTML = 'Start date/ time , End date/time';
		details_leftside_container.appendChild(endDate);

		ties = document.createElement('div');
		ties.id = 'ties';
		ties.classList.add("details_content");
		details_leftside_container.appendChild(ties);

		entriesPerCostumer = document.createElement('div');
		entriesPerCostumer.id = 'entriesPerCostumer';
		entriesPerCostumer.classList.add("details_content");
		details_leftside_container.appendChild(entriesPerCostumer);

		maxEntries = document.createElement('div');
		maxEntries.id = 'maxEntries';
		maxEntries.classList.add("details_content");
		details_leftside_container.appendChild(maxEntries);

		

		nameOfEntrant = document.createElement('div');
		nameOfEntrant.id = 'nameOfEntrant';
		nameOfEntrant.classList.add("details_content");
		// nameOfEntrant.innerHTML = "<?php echo NAMEOFENTRANT ?>";
		details_leftside_container.appendChild(nameOfEntrant);

		prizes = document.createElement('div');
		prizes.id = 'prizeListing';
		prizes.classList.add("details_content");
		prizes.innerHTML = "<?php echo PRIZELISTING ?>";
		details_rightside_container.appendChild(prizes);

		prizeListing = document.createElement('div');
		prizeListing.id = 'prizeListing';
		prizeListing.classList.add("prizeListing");
		details_rightside_container.appendChild(prizeListing);



		prizeListingTable = document.createElement('table');
		prizeListingTable.id = 'prizeListingTable';
		prizeListingTable.classList.add("prizeListingTable");
		prizeListing.appendChild(prizeListingTable);

		prizeListingTableHead = document.createElement('thead');
		prizeListingTableHead.id = 'prizeListingTableHead';
		prizeListingTable.appendChild(prizeListingTableHead);

		prizeListingTableHeadTR = document.createElement('tr');
		prizeListingTableHeadTR.id = 'prizeListingTableHeadTR';
		prizeListingTableHeadTR.classList.add("prizeListingTableHeadTR");
		prizeListingTableHead.appendChild(prizeListingTableHeadTR);

		prizeListingTableHeadTRRank = document.createElement('th');
		prizeListingTableHeadTRRank.id = 'prizeListingTableHeadTRTH';
		prizeListingTableHeadTRRank.innerHTML = "<?php echo RANK ?>";
		prizeListingTableHeadTRRank.classList.add("prizeListingTableHead");
		// slots_div_tournament_status_rank.classList.add("slots_div_tournament_status_leaders_header");
		prizeListingTableHeadTR.appendChild(prizeListingTableHeadTRRank);

		prizeListingTableHeadTRValue = document.createElement('th');
		prizeListingTableHeadTRValue.id = 'prizeListingTableHeadTRValue';
		prizeListingTableHeadTRValue.innerHTML = "<?php echo PRIZELISTING ?>";
		prizeListingTableHeadTRValue.classList.add("prizeListingTableHead");
		// slots_div_tournament_status_name.classList.add("slots_div_tournament_status_leaders_header");
		prizeListingTableHeadTR.appendChild(prizeListingTableHeadTRValue);

		prizeListingTableBody = document.createElement('tbody');
		prizeListingTableBody.id = 'prizeListingTableBody';
		prizeListingTableBody.classList.add("prizeListingTableBody");
		prizeListingTable.appendChild(prizeListingTableBody);
	};


</script>

<body>
</body>
</html>