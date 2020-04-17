

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

	function TournamentDetailsValue(_params,_gameInfo){
		console.log('TournamentDetailsValue', _params);
		console.log('this.tournametAssetsPath====',_gameInfo,_logoPath,_logoName)

		_tournamentDetails = this;

		// _tournamentDetails.path = 
		// gameLogo.innerHTML = "LOGO";

		gameLogoImg.src = _logoPath;

		gameTitleLbl.innerHTML = "<?php echo GAME ?>";
		gameTitleVal.innerHTML = _logoName;


		if(_params.contest.description){
			tournamentName.innerHTML = _params.contest.description;
		}else{
			tournamentName.style.display = 'none';
		}
		if(_params.contest.remainingTime){
			remainingTimeLbl.innerHTML = "<?php echo TIMELIMIT ?>";
			remainingTimeVal.innerHTML = _params.contest.remainingTime;
		}else{
			remainingTime.style.display = 'none';
		}
		if( _params.contest.entryFee){
			entryFeeLbl.innerHTML = "<?php echo ENTRYFEE ?>";
			entryFeeVal.innerHTML =  _params.contest.entryFee;
		}else{
			entryFee.style.display = 'none';
		}
		if(_params.contest.maxRounds){
			maxRoundsLbl.innerHTML = "<?php echo MAXROUNDS ?>";
			maxRoundsVal.innerHTML = _params.contest.maxRounds;
		}else{
			maxRounds.style.display = 'none';
		}
		if(_params.contest.startDate){
			startEndTimeLbl.innerHTML = "<?php echo START ?>";
			startEndTimeVal.innerHTML = _params.contest.startDate;
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
			endDateLbl.innerHTML = "<?php echo END ?>";
			endDateVal.innerHTML = _params.contest.endDate;
		}else{
			endDate.style.display = 'none';
		}

		tiesLbl.innerHTML = "<?php echo TIES ?>";
		tiesVal.innerHTML = "<?php echo PRIZESPLITTING ?>";
		

		if(_params.contest.entriesPerCostumer){
			entriesPerCostumerLbl.innerHTML = "<?php echo ENTRIESPERCOSTUMER ?>";
			entriesPerCostumerVal.innerHTML = _params.contest.entriesPerCostumer;
		}else{
			entriesPerCostumer.style.display = 'none';
		}
		if(_params.contest.maxEntries){
			maxEntriesLbl.innerHTML = "<?php echo MAXENTRIES ?>";
			maxEntriesVal.innerHTML = _params.contest.maxEntries;
		}else{
			maxEntries.style.display = 'none'
		}
		tiesHelp.innerHTML =  "<?php echo TIESHELP ?>";


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
				prizeListingTableBodyRank.classList.add("blackBackground");
				prizeListingTableBodyValue.classList.add("blackBackground");
			}else{
				prizeListingTableBodyRank.classList.add("grayBackground");
				prizeListingTableBodyValue.classList.add("grayBackground");
			}


		}


		_tournamentDetails.onTouch = function(_params){
			switch(_params.type){
				case 'mouseover':
				console.log('***************************mouseover********************')
				tiesHelp.style.display = 'inline-block';
				break;
				case 'mouseout':
				console.log('***************************mouseout********************')
				tiesHelp.style.display = 'none';
				break;
			}
		}
		
		
	};
	timerUpdate = function(_value){
		console.log('details_UPDATE', _value);
		switch(_value.type){
			case 'UPDATE_TIME':
			if(remainingTime.style.display != 'none'){
				remainingTimeLbl.innerHTML = "<?php echo TIMELIMIT ?>";
				remainingTimeVal.innerHTML =  _value.data;
			}
			break;
		}
	};
	init_Details = function(_path){
		// details_container = document.getElementById("details_container");

		console.log('INIT DETAILS');
		console.log('this.tournametAssetsPath',_path,_tournamentDetails)

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
		details_leftside_container.appendChild(gameTitle);

		gameTitleLbl= document.createElement('div');
		gameTitleLbl.id = 'gameTitleLbl';
		gameTitleLbl.classList.add("details_Label");
		gameTitle.appendChild(gameTitleLbl);

		gameTitleVal= document.createElement('div');
		gameTitleVal.id = 'gameTitleVal';
		gameTitleVal.classList.add("details_Value");
		gameTitle.appendChild(gameTitleVal);

		remainingTime = document.createElement('div');
		remainingTime.id = 'remainingTime';
		remainingTime.classList.add("details_content");
		details_leftside_container.appendChild(remainingTime);

		remainingTimeLbl = document.createElement('div');
		remainingTimeLbl.id = 'remainingTimeLbl';
		remainingTimeLbl.classList.add("details_Label");
		remainingTime.appendChild(remainingTimeLbl);

		remainingTimeVal = document.createElement('div');
		remainingTimeVal.id = 'remainingTimeVal';
		remainingTimeVal.classList.add("details_Value");
		remainingTime.appendChild(remainingTimeVal); 

		entryFee = document.createElement('div');
		entryFee.id = 'entryFee';
		entryFee.classList.add("details_content");
		// entryFee.innerHTML = "<?php echo ENTRYFEE ?>" + '9999';
		details_leftside_container.appendChild(entryFee);

		entryFeeLbl = document.createElement('div');
		entryFeeLbl.id = 'entryFeeLbl';
		entryFeeLbl.classList.add("details_Label");
		entryFee.appendChild(entryFeeLbl);

		entryFeeVal = document.createElement('div');
		entryFeeVal.id = 'entryFeeVal';
		entryFeeVal.classList.add("details_Value");
		entryFee.appendChild(entryFeeVal); 


		maxRounds = document.createElement('div');
		maxRounds.id = 'maxRounds';
		maxRounds.classList.add("details_content");
		details_leftside_container.appendChild(maxRounds); 

		maxRoundsLbl = document.createElement('div');
		maxRoundsLbl.id = 'maxRoundsLbl';
		maxRoundsLbl.classList.add("details_Label");
		maxRounds.appendChild(maxRoundsLbl);

		maxRoundsVal = document.createElement('div');
		maxRoundsVal.id = 'maxRoundsVal';
		maxRoundsVal.classList.add("details_Value");
		maxRounds.appendChild(maxRoundsVal); 

		startEndTime = document.createElement('div');
		startEndTime.id = 'startEndTime';
		startEndTime.classList.add("details_content");
		// startEndTime.innerHTML = 'Start date/ time , End date/time';
		details_leftside_container.appendChild(startEndTime);

		startEndTimeLbl = document.createElement('div');
		startEndTimeLbl.id = 'startEndTimeLbl';
		startEndTimeLbl.classList.add("details_Label");
		startEndTime.appendChild(startEndTimeLbl);

		startEndTimeVal = document.createElement('div');
		startEndTimeVal.id = 'startEndTimeVal';
		startEndTimeVal.classList.add("details_Value");
		startEndTime.appendChild(startEndTimeVal); 


		endDate = document.createElement('div');
		endDate.id = 'startEndTime';
		endDate.classList.add("details_content");
		// startEndTime.innerHTML = 'Start date/ time , End date/time';
		details_leftside_container.appendChild(endDate);

		endDateLbl = document.createElement('div');
		endDateLbl.id = 'endDateLbl';
		endDateLbl.classList.add("details_Label");
		endDate.appendChild(endDateLbl);

		endDateVal = document.createElement('div');
		endDateVal.id = 'endDateVal';
		endDateVal.classList.add("details_Value");
		endDate.appendChild(endDateVal); 

		ties = document.createElement('div');
		ties.id = 'ties';
		ties.classList.add("details_content");
		details_leftside_container.appendChild(ties);

		tiesLbl = document.createElement('div');
		tiesLbl.id = 'tiesLbl';
		tiesLbl.classList.add("details_Label");
		ties.appendChild(tiesLbl);

		tiesVal = document.createElement('div');
		tiesVal.id = 'endDateVal';
		tiesVal.classList.add("details_Value");
		ties.appendChild(tiesVal); 

		infoBtn = document.createElement('div');
		infoBtn.id = 'infoBtn';
		infoBtn.classList.add("infoBtn");
		console.log(_path+'res/Images/infoBtn.png')
		infoBtn.style.backgroundImage  = "url("+_path+"res/Images/infoBtn.png)";
		ties.appendChild(infoBtn); 

		infoBtn.addEventListener("mouseover", function(e) {   
			_tournamentDetails.onTouch({type:'mouseover',currentTarget:infoBtn});
		});
		infoBtn.addEventListener("mouseout", function(e) {   
			_tournamentDetails.onTouch({type:'mouseout',currentTarget:infoBtn});
		});


		tiesHelp = document.createElement('div');
		tiesHelp.id = 'tiesHelp';
		tiesHelp.classList.add("tiesHelp");
		infoBtn.appendChild(tiesHelp); 

		entriesPerCostumer = document.createElement('div');
		entriesPerCostumer.id = 'entriesPerCostumer';
		entriesPerCostumer.classList.add("details_content");
		details_leftside_container.appendChild(entriesPerCostumer);

		entriesPerCostumerLbl = document.createElement('div');
		entriesPerCostumerLbl.id = 'entriesPerCostumerLbl';
		entriesPerCostumerLbl.classList.add("details_Label");
		entriesPerCostumer.appendChild(entriesPerCostumerLbl);

		entriesPerCostumerVal = document.createElement('div');
		entriesPerCostumerVal.id = 'entriesPerCostumerVal';
		entriesPerCostumerVal.classList.add("details_Value");
		entriesPerCostumer.appendChild(entriesPerCostumerVal); 

		maxEntries = document.createElement('div');
		maxEntries.id = 'maxEntries';
		maxEntries.classList.add("details_content");
		details_leftside_container.appendChild(maxEntries);

		maxEntriesLbl = document.createElement('div');
		maxEntriesLbl.id = 'maxEntriesLbl';
		maxEntriesLbl.classList.add("details_Label");
		maxEntries.appendChild(maxEntriesLbl);

		maxEntriesVal = document.createElement('div');
		maxEntriesVal.id = 'maxEntriesVal';
		maxEntriesVal.classList.add("details_Value");
		maxEntries.appendChild(maxEntriesVal); 



		nameOfEntrant = document.createElement('div');
		nameOfEntrant.id = 'nameOfEntrant';
		nameOfEntrant.classList.add("details_content");
		// nameOfEntrant.innerHTML = "<?php echo NAMEOFENTRANT ?>";
		details_leftside_container.appendChild(nameOfEntrant);

		prizes = document.createElement('div');
		prizes.id = 'prizes';
		prizes.classList.add("prizes");
		prizes.innerHTML = "<?php echo PRIZE ?>";
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