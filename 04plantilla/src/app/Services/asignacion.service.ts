import { HttpClient } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { IAsignacion } from '../Interfaces/iasignacion';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AsignacionesService {
  apiurl = 'http://localhost/school/escuela/controllers/asignaciones.controller.php?op=';

  constructor(private lector: HttpClient) {}

  buscar(texto: string): Observable<IAsignacion> {
    const formData = new FormData();
    formData.append('texto', texto);
    return this.lector.post<IAsignacion>(this.apiurl + 'uno', formData);
  }

  todos(): Observable<IAsignacion[]> {
    return this.lector.get<IAsignacion[]>(this.apiurl + 'todos');
  }

  uno(asignacion_id: number): Observable<IAsignacion> {
    const formData = new FormData();
    formData.append('asignacion_id', asignacion_id.toString());
    return this.lector.post<IAsignacion>(this.apiurl + 'uno', formData);
  }

  eliminar(asignacion_id: number): Observable<number> {
    const formData = new FormData();
    formData.append('asignacion_id', asignacion_id.toString());
    return this.lector.post<number>(this.apiurl + 'eliminar', formData);
  }

  insertar(asignacion: IAsignacion): Observable<string> {
    const formData = new FormData();
    formData.append('estudiante_id', asignacion.estudiante_id.toString());
    formData.append('profesor_id', asignacion.profesor_id.toString());
    // Add other fields if necessary
    return this.lector.post<string>(this.apiurl + 'insertar', formData);
  }

  actualizar(asignacion: IAsignacion): Observable<string> {
    const formData = new FormData();
    formData.append('asignacion_id', asignacion.asignacion_id.toString());
    formData.append('estudiante_id', asignacion.estudiante_id.toString());
    formData.append('profesor_id', asignacion.profesor_id.toString());
    // Add other fields if necessary
    return this.lector.post<string>(this.apiurl + 'actualizar', formData);
  }
}
