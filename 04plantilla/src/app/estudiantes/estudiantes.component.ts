import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { IEstudiante } from '../Interfaces/iestudiante';
import { EstudiantesService } from '../Services/estudiantes.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-estudiantes',
  standalone: true,
  imports: [RouterLink, SharedModule],
  templateUrl: './estudiantes.component.html',
  styleUrl: './estudiantes.component.scss'
})
export class EstudiantesComponent {
  listaestudiantes: IEstudiante[] = [];
  constructor(private estudianteServicio: EstudiantesService) {}

  ngOnInit() {
    this.cargatabla();
  }

  cargatabla() {
    this.estudianteServicio.todos().subscribe((data) => {
      console.log(data);
      this.listaestudiantes = data;
    });
  }

  eliminar(idEstudiantes) {
    Swal.fire({
      title: 'Estudiantes',
      text: '¿Está seguro de que desea eliminar el estudiante?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar Estudiante'
    }).then((result) => {
      if (result.isConfirmed) {
        this.estudianteServicio.eliminar(idEstudiantes).subscribe((data) => {
          Swal.fire('Estudiantes', 'El estudiante ha sido eliminado.', 'success');
          this.cargatabla();
        });
      }
    });
  }
}
