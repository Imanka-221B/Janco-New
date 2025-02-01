 
        document.getElementById('constructionAreaLink').addEventListener('click', function() {
        document.getElementById('mainContent').innerHTML = `

        <div class="container mt-4">  

            <div class="bsn-group mb-3" role="group"> 

                <button class="btn bsn-secondary">Labourer Details</button>  
                <button class="btn bsn-secondary">Labourer Attendance</button>  
                <button id="labourerSalaryLink"class="btn bsn-secondary">Labourer Salary</button>  
                <button class="btn bsn-secondary">Material Stock</button>  
                <button class="btn bsn-secondary">Site Expenses</button>  

            </div>  
        </div> 
        
        <div class="labour-details">
            <h2>Labourer Details</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Labourer ID</th>
                        <th>Name</th>
                        <th>Phone Number</th>
                        <th>Skilled/Non-Skilled</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Add 20 labour details -->
                    <tr>
                        <td>JHC / Amp/001</td>
                        <td>N K Airyasena</td>
                        <td>(225) 555-0118</td>
                        <td>Skilled</td>
                        <td>
                            <button class="btn btn-warning btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </td>
                    </tr>
                   
                </tbody>
            </table>
        </div>

        <!-- Add Labour Button -->
        <div class="add-labour-btn">
            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#addLabourModal">Add Labour</button>
        </div>
    </div>

    <!-- Add Labour Modal -->
    <div class="modal fade" id="addLabourModal" tabindex="-1" aria-labelledby="addLabourModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addLabourModalLabel">Add Labour</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label for="labourerId" class="form-label">Labourer ID</label>
                            <input type="text" class="form-control" id="labourerId" required>
                        </div>
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="skillLevel" class="form-label">Skilled/Non-Skilled</label>
                            <select class="form-control" id="skillLevel" required>
                                <option value="Skilled">Skilled</option>
                                <option value="Non-Skilled">Non-Skilled</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>`;
        });
    
        document.getElementById('addLabourForm').addEventListener('submit', function(e) {
            e.preventDefault();
            const name = document.getElementById('labourerName').value;
            const phone = document.getElementById('labourerPhone').value;
            const skill = document.getElementById('labourerSkill').value;
            alert(`Labourer Added:\nName: ${name}\nPhone: ${phone}\nSkill: ${skill}`);
            document.getElementById('addLabourForm').reset();
            const modal = bootstrap.Modal.getInstance(document.getElementById('addLabourModal'));
            modal.hide();
        });
    


    document.getElementById('labourerSalaryLink').addEventListener('click', function() {
    document.getElementById('labourerSalary').innerHTML = `

    <div class="container mt-4">  

        <div class="bsn-group mb-3" role="group"> 

            <button class="btn bsn-secondary">Labourer Details</button>  
            <button class="btn bsn-secondary">Labourer Attendance</button>  
            <button id="labourerSalaryLink"class="btn bsn-secondary">Labourer Salary</button>  
            <button class="btn bsn-secondary">Material Stock</button>  
            <button class="btn bsn-secondary">Site Expenses</button>  

        </div>  
     </div> 

        <div class="labour-details">
        <h2>Labourer Details</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Labourer ID</th>
                    <th>Name</th>
                    <th>Phone Number</th>
                    <th>Skilled/Non-Skilled</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Add 20 labour details -->
                <tr>
                    <td>JHC / Amp/001</td>
                    <td>N K Imanka</td>
                    <td>(225) 555-0118</td>
                    <td>Skilled</td>
                    <td>
                        <button class="btn btn-warning btn-sm">Edit</button>
                        <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                </tr>
               
            </tbody>
        </table>
    </div>
            
        
        `;
    });
