import { TestBed } from '@angular/core/testing';

import { SpecialitiesService } from './specialities.service';

describe('SpecialtiesService', () => {
  let service: SpecialitiesService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(SpecialitiesService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
