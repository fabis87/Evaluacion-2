import { Component, OnInit } from '@angular/core';
import { FormControl, FormGroup, ReactiveFormsModule, Validators } from '@angular/forms';
import { AsignacionesService } from 'src/app/Services/asignaciones.service';
import { IAsignacion } from 'src/app/Interfaces/iasignacion';
import { CommonModule } from '@angular/common';
import Swal from 'sweetalert2';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-nuevaasignacion',
  standalone: true,
  imports: [ReactiveFormsModule, CommonModule],
  templateUrl: './nuevaasignacion.component.html',
  styleUrl: './nuevaasignacion.component.scss'
})
export class NuevaAsignacionComponent implements OnInit {
  frm_Asignacion = new FormGroup({
    asignacion_id: new FormControl('', Validators.required),
    estudiante_id: new FormControl('', Validators.required),
    profesor_id: new FormControl('', Validators.required)
  });

  asignacion_id = 0;
  titulo = 'Nueva Asignación';

  constructor(
    private asignacionServicio: AsignacionesService,
    private navegacion: Router,
    private ruta: ActivatedRoute
  ) {}

  ngOnInit(): void {
    this.asignacion_id = parseInt(this.ruta.snapshot.paramMap.get('idAsignacion') || '0', 10);
    if (this.asignacion_id > 0) {
      this.asignacionServicio.uno(this.asignacion_id).subscribe((unaAsignacion) => {
        this.frm_Asignacion.controls['asignacion_id'].setValue(unaAsignacion.asignacion_id);
        this.frm_Asignacion.controls['estudiante_id'].setValue(unaAsignacion.estudiante_id);
        this.frm_Asignacion.controls['profesor_id'].setValue(unaAsignacion.profesor_id);

        this.titulo = 'Editar Asignación';
      });
    }
  }

  grabar() {
    let asignacion: IAsignacion = {
      asignacion_id: this.frm_Asignacion.controls['asignacion_id'].value,
      estudiante_id: this.frm_Asignacion.controls['estudiante_id'].value,
      profesor_id: this.frm_Asignacion.controls['profesor_id'].value
    };

    Swal.fire({
      title: 'Asignaciones',
      text: '¿Desea guardar la asignación?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#f00',
      cancelButtonColor: '#3085d6',
      confirmButtonText: 'Grabar!'
    }).then((result) => {
      if (result.isConfirmed) {
        if (this.asignacion_id > 0) {
          this.asignacionServicio.actualizar(asignacion).subscribe((res: any) => {
            Swal.fire({
              title: 'Asignaciones',
              text: res.mensaje,
              icon: 'success'
            });
            this.navegacion.navigate(['/asignaciones']);
          });
        } else {
          this.asignacionServicio.insertar(asignacion).subscribe((res: any) => {
            Swal.fire({
              title: 'Asignaciones',
              text: res.mensaje,
              icon: 'success'
            });
            this.navegacion.navigate(['/asignaciones']);
          });
        }
      }
    });
  }
}
