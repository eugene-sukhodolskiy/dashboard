class Search{
	constructor(searchInputSelector, cardSelector){
		if(!String.prototype.trim){String.prototype.trim = function(){return this.replace(/^s+|s+$/g,'');}}
		this.input = $(searchInputSelector);
		this.cards = $(cardSelector);
		this.cardsData = [];
		this.init();
	}

	init(){
		let self = this;

		for(let i=0; i<this.cards.length; i++){
			let cardData = {
				title: $(this.cards[i]).attr('data-title').toLowerCase(),
				tags: JSON.parse($(this.cards[i]).attr('data-tags')),
				element: $(this.cards[i])
			};
			this.cardsData.push(cardData);
		}

		$(this.input).on('input', function(){
			if($(this).val().length){
				self.search($(this).val().toLowerCase());
			}else{
				self.showAll();
			}
		});
	}

	search(searchString, by){
		this.hideAll();
		if(typeof by == 'undefined' || by == 'title'){
			console.log('by title', this.filterShowByTitle(this.cardsData, searchString));
		}
		if(typeof by == 'undefined' || by == 'tags'){
			console.log('by tags', this.filterShowByTags(this.cardsData, searchString));
		}
	}

	hideAll(){
		$(this.cards).each(function(){
			$(this).parent().hide();
		});
	}

	showAll(){
		$(this.cards).each(function(){
			$(this).parent().show();
		});
	}

	showCard(card){
		$(card.element).parent().show();
	}

	filterShowByTitle(items, title){
		let filteringItems = [];
		for(let i of items){
			if(i.title.indexOf(title) > -1){
				filteringItems.push(i);
				this.showCard(i);
			}
		}

		return filteringItems;
	}

	filterShowByTags(items, tagString){
		let filteringItems = [];

		let stags = tagString.split(',');
		for(let i=0; i<stags.length; i++){
			stags[i] = stags[i].trim().toLowerCase();
		}

		for(let i of items){
			let counter = 0;
			for(let tag of i.tags){
				tag = tag.trim().toLowerCase();
				for(let stag of stags){
					if(stag == tag){
						counter++
					}
				}
			}

			i.counter = counter;
		}

		let max = -1;
		for(let i of items){
			if(max < i.counter && i.counter){
				max = i.counter;
			}
		}

		for(let i of items){
			if(i.counter == max){
				filteringItems.push(i);
				this.showCard(i);
			}
		}

		return filteringItems;
	}
}