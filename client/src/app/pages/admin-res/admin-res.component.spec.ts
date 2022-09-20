import { ComponentFixture, TestBed } from '@angular/core/testing';

import { AdminResComponent } from './admin-res.component';

describe('AdminResComponent', () => {
  let component: AdminResComponent;
  let fixture: ComponentFixture<AdminResComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ AdminResComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(AdminResComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
