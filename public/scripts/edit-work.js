jQuery(document).ready(function () {
    $collectionHolder = $('div#work_experience_duty');
    
    $collectionHolder.find('[id^=work_experience_duty]').each(function () {
    addTagFormDeleteLink($(this));
    });
    });
    
    function addTagFormDeleteLink($tagFormLi) {
        var $removeFormButton = $('<button class="btn-delete" type="button">Delete</button>');
        $tagFormLi.append($removeFormButton);
        
        $removeFormButton.on('click', function (e) {
        $tagFormLi.remove();
        });
    }
    
    jQuery(document).ready(function () {
    
        var $tagsCollectionHolder = $('div.duties');
        
        $tagsCollectionHolder.data('index', $tagsCollectionHolder.find('input').length);
        
        $('body').on('click', '.add_item_link', function (e) {
        var $collectionHolderClass = $(e.currentTarget).data('collectionHolderClass');
        
        addFormToCollection($collectionHolderClass);
        })
    });
    
    
    function addFormToCollection($collectionHolderClass) {

        var id = parseInt($('[id^=work_experience_duty]').last().attr('id').replace(/[^\d]/g, ''), 10);
        
        var $collectionHolder = $('.' + $collectionHolderClass);
        
        var prototype = $collectionHolder.data('prototype');
        
        var index = $collectionHolder.data('index');
        
        var newForm = prototype;
        
        console.log(id);

        newForm = newForm.replace(/__name__/g, index + (Number.isInteger(id) ? id : 1));
        
        $collectionHolder.data('index', index + (Number.isInteger(id) ? id : 1));
        
        var $newFormLi = $('<div class="add-duty"></div>').append(newForm);
        
        $newFormLi.append('<button class="btn-delete remove-tag" type="button">Delete</button>');
        
        $collectionHolder.append($newFormLi)
        
        $newFormLi.before($newFormLi);
        
        $('.remove-tag').click(function (e) {
        e.preventDefault();
        
        $(this).parent().remove();
        
        return false;
        });
    }