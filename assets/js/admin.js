document.addEventListener('DOMContentLoaded', (event) => {

	function checkSelectedElements(){

		var elements = document.querySelectorAll("#preset_actions_repeat_group_repeat .cmb-repeatable-grouping");

		elements.forEach(
			function(element) {
				selectedOption = element.querySelector(".preset-action-options select").value;

				var allFields = element.querySelectorAll(".display");
				
				allFields.forEach(
					function(field) {

						field.classList.add("hide");
						field.classList.remove("display");

					}
				)		

				if (selectedOption != '') {
					var fieldsSelected = element.querySelectorAll("." + selectedOption);

					fieldsSelected.forEach(
						function(field) {

							field.classList.remove("hide");
							field.classList.add("display");

						}
					)
				}
			}
		);
	}

	checkSelectedElements();

	document.addEventListener('change',function(event){

		var element = event.target;
		
		if (element.id.includes("preset_actions_repeat_group") || element.dataset.selector.includes("preset_actions_repeat_group_repeat")) {
			checkSelectedElements();
		}
		
	})

	document.addEventListener('click',function(event){

		var element = event.target;
		
		if (element.id.includes("preset_actions_repeat_group") || element.dataset.selector.includes("preset_actions_repeat_group_repeat")) {
			checkSelectedElements();
		}

	})
})
