import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { IProfesor } from '../Interfaces/iprofesor';
import { ProfesoresService } from '../Services/profesores.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-profesores',
  standalone: true,
  imports: [RouterLink, SharedModule],
  templateUrl: './profesores.component.html',
  styleUrls: ['./profesores.component.scss']
})
export class ProfesoresComponent implements OnInit {
  listaprofesores: IProfesor[] = [];
  
  constructor(private profesorServicio: ProfesoresService) {}

  ngOnInit() {
    this.cargatabla();
  }

  cargatabla() {
    this.profesorServicio.todos().subscribe((data) => {
      console.log(data);
      this.listaprofesores = data;
    });
  }

  eliminar(idProfesor: number) {
    Swal.fire({
      title: 'Profesores',
      text: '¿Está seguro de que desea eliminar el profesor?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar Profesor'
    }).then((result) => {
      if (result.isConfirmed) {
        this.profesorServicio.eliminar(idProfesor).subscribe(() => {
          Swal.fire('Profesores', 'El profesor ha sido eliminado.', 'success');
          this.cargatabla();
        });
      }
    });
  }
}
