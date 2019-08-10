<div class="modal fade" id="details">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4>@{{showInstitution.name}}</h4> 
                    <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                    </button>                       
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="director"></label>
                        <p><strong>Director: </strong>@{{showInstitution.director}}</p>   
                        <p><strong>Dirección: </strong>@{{showInstitution.address}}</p>
                        <p><strong>Teléfono: </strong>@{{showInstitution.telephone}}</p> 
                    </div>
                </div>  
                <div class="modal-footer">
                    <div id="map" ></div>
                </div>        
            </div>
        </div>
    </div>