<div class="modal fade" id="details">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Usuario: @{{user_show.email}}</h4> 
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>                       
            </div>
            <div class="modal-body">
                <li class="list-group">Nombre y Apellido: @{{user_show.name}} @{{user_show.surname}}</li>
                <li class="list-group">estado: @{{ user_show.state}}</li>
            </div>  
        </div>
    </div>
</div>