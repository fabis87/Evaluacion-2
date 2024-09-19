import { Component, OnInit } from '@angular/core';
import { RouterLink } from '@angular/router';
import { SharedModule } from 'src/app/theme/shared/shared.module';
import { IAsignacion } from '../Interfaces/iasignacion';
import { AsignacionesService } from '../Services/asignaciones.service';
import Swal from 'sweetalert2';

@Component({
  selector: 'app-asignaciones',
  standalone: true,
  imports: [RouterLink, SharedModule],
  templateUrl: './asignaciones.component.html',
  styleUrls: ['./asignaciones.component.scss']
})
export class AsignacionesComponent implements OnInit {
  listaAsignaciones: IAsignacion[] = [];

  constructor(private asignacionesServicio: AsignacionesService) {}

  ngOnInit() {
    this.cargarTabla();
  }

  cargarTabla() {
    this.asignacionesServicio.todos().subscribe((data) => {
      console.log(data);
      this.listaAsignaciones = data;
    });
  }

  eliminar(idAsignacion: number) {
    Swal.fire({
      title: 'Asignaciones',
      text: '¿Está seguro de que desea eliminar la asignación?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#d33',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Eliminar Asignación'
    }).then((result) => {
      if (result.isConfirmed) {
        this.asignacionesServicio.eliminar(idAsignacion).subscribe((data) => {
          Swal.fire('Asignaciones', 'La asignación ha sido eliminada.', 'success');
          this.cargarTabla();
        });
      }
    });
  }
}
