class Search{
	constructor(searchInputSelector, cardSelector){
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
				self.hideAll();
				self.filterShowByTitle(self.cardsData, $(this).val().toLowerCase());
			}else{
				self.showAll();
			}
		});
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
}