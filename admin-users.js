const users=[
    {   
        id:1,
        firstName:"Kamil",
        lastName:"Çoban",
        email:"kamil.cobann.0@gmail.com",
        gender:"Male",
        birthday:"04.08.2000"
    },{   
        id:2,
        firstName:"Cem",
        lastName:"Çoban",
        email:"cem.cobann.0@gmail.com",
        gender:"Male",
        birthday:"04.08.2000"
    },{   
        id:3,
        firstName:"John",
        lastName:"Davis",
        email:"johndavis@hotmail.com",
        gender:"Male",
        birthday:"04.02.1988"
    },{   
        id:4,
        firstName:"Fatma",
        lastName:"Oturaklı",
        email:"fatma1230@gmail.com",
        gender:"Female",
        birthday:"04.07.1969"
    },{   
        id:5,
        firstName:"Nalan",
        lastName:"Sayar",
        email:"sayarnalan@gmail.com",
        gender:"Female",
        birthday:"04.08.1971"
    },{   
        id:6,
        firstName:"Bahattin",
        lastName:"Oturakli",
        email:"kamil.cobann.0@gmail.com",
        gender:"Male",
        birthday:"04.08.1988"
    },{   
        id:7,
        firstName:"Akın Cem",
        lastName:"Tutal",
        email:"akincemtutal@gmail.com",
        gender:"Male",
        birthday:"01.01.2000"
    },{   
        id:8,
        firstName:"Füsun",
        lastName:"Çoban",
        email:"fusun@gmail.com",
        gender:"Female",
        birthday:"01.01.1971"
    },{   
        id:9,
        firstName:"Nur",
        lastName:"Küçükzebil",
        email:"dnk@gmail.com",
        gender:"Female",
        birthday:"01.12.2000"
    },{   
        id:10,
        firstName:"Ahmet",
        lastName:"Duvar",
        email:"duvarahmt@gmail.com",
        gender:"Male",
        birthday:"23.01.2000"
    },{   
        id:11,
        firstName:"Celal",
        lastName:"Şengör",
        email:"celalsngr@gmail.com",
        gender:"Male",
        birthday:"01.01.1945"
    },{   
        id:12,
        firstName:"Mahmut",
        lastName:"Apalak",
        email:"mahmut@gmail.com",
        gender:"Male",
        birthday:"01.01.1935"
    },{   
        id:13,
        firstName:"Güler",
        lastName:"Çoban",
        email:"cbnguler@gmail.com",
        gender:"Female",
        birthday:"01.01.1945"
    },{   
        id:14,
        firstName:"Yiğit",
        lastName:"Anahtarcı",
        email:"anahtar@gmail.com",
        gender:"Male",
        birthday:"01.03.2000"
    }

];




tableBodyDOM = document.querySelector('#table-body');
listAll();
function listAll(){
    let content = " ";
    users.map((e)=>{
        content+=createUser(e);
    })
    tableBodyDOM.innerHTML = content;
}



function createUser(myUser){
    return `
    <tr>
        <th scope="col">${myUser.id}</th>
        <td>${myUser.firstName}</td>
        <td>${myUser.lastName}</td>
        <td>${myUser.email}</td>
        <td>${myUser.gender}</td>
        <td>${myUser.birthday}</td>
        <td>
        <button type="button" class="btn btn-outline-primary mb-2" data-bs-toggle="modal" data-bs-target="#editModal" onclick="editItem()">
        Edit
        </button>
        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          ((I WILL WRITE A FUNCTION))
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                          <button type="button" class="btn btn-primary">Save changes</button>
                        </div>
                      </div>
                    </div>
                  </div>
        <button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" onclick="deleteItem()">
        Delete
        </button>
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="deleteModalLabel">Delete User</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          Are you sure that you want to delete this User?
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                          <button type="button" class="btn btn-danger">Delete</button>
                        </div>
                      </div>
                    </div>
                  </div>
        </td>
    </tr>
    `;
}

// MODAL ADD DELETE EDIT

var myModal = document.getElementById('myModal')
var myInput = document.getElementById('myInput')

myModal.addEventListener('shown.bs.modal', function () {
  myInput.focus()
})
