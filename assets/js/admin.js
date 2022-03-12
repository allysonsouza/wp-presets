document.addEventListener('DOMContentLoaded', (event) => {

	function checkSelectedElements(){

		var elements = document.querySelectorAll("#wiki_test_repeat_group_repeat .cmb-repeatable-grouping");

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

				var fieldsSelected = element.querySelectorAll("." + selectedOption);

				fieldsSelected.forEach(
					function(field) {

						field.classList.remove("hide");
						field.classList.add("display");

					}
				)
			}
		);
	}

	checkSelectedElements();

	document.addEventListener('change',function(e){

		if (e.target.id.includes("wiki_test_repeat_group") ) {
			checkSelectedElements();
		}
	})

})
