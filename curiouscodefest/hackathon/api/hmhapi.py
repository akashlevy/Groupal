"""A Python library for interacting with HMH sandbox API"""

import json
import requests
import time
import uuid
from urlparse import urljoin


# Information for requesting data
ENDPOINT = "http://sandbox.api.hmhco.com/"
API_KEY = "f5380717465b85f4934750bd021e05af"
CLIENT_ID = "f8783d9c-5646-4d21-902b-dcfc7b31dc74.hmhco.com"
CLIENT_SECRET = "ahqMOzFzZ7c"

REFRESH_TOKEN = None
ACCESS_TOKEN = None
TOKENS_RETRIEVED = None
EXPIRE_TIME = 3600


def _sample_token():
    """Return response from fetching SIF authorization for a user"""
    params = [("client_id", CLIENT_ID),
              ("grant_type", "password"),
              ("username", "sauron"),
              ("password", "password")]
    headers = {"Content-Type": "application/x-www-form-urlencoded"}
    return _request("POST", "/v1/sample_token", params, headers=headers)


def get_tokens():
    """Get refresh and access tokens"""
    request = _sample_token()
    print request.text
    ACCESS_TOKEN = request.json()["access_token"]
    REFRESH_TOKEN = request.json()["refresh_token"]
    TOKENS_RETRIEVED = request.json()["timestamp"]
        

def get_tokens_expired():
    """Return whether or not tokens are expired"""
    return time.time() >= TOKENS_RETRIEVED + EXPIRE_TIME


def _request(method, url, params=None, data=None, headers={}):
    """Send a request to the HMH server"""
    headers["Accept"] = "application/json"
    auth = _HMHAuth(API_KEY, ACCESS_TOKEN)
    return requests.request(method, urljoin(ENDPOINT, url), params=params,
                            data=json.dumps(data), headers=headers, auth=auth)


def _get_students():
    """Return response from retrieving all students"""
    return _request("GET", "/v1/students")


def _get_student(ref_id):
    """Return response from retrieving a student with ref_id"""
    return _request("GET", "/v1/students/%s" % ref_id)
    

def _get_sections():
    """Return response from retrieving all sections"""
    return _request("GET", "/v1/sections")


def _get_section(ref_id):
    """Return response from retrieving section with ref_id"""
    return _request("GET", "/v1/sections/%s" % ref_id)


def _get_schools():
    """Return response from retrieving all schools"""
    return _request("GET", "/v1/schools")


def _get_school(ref_id):
    """Return response from retrieving school with ref_id"""
    return _request("GET", "/v1/schools/%s" % ref_id)
    

def _get_staff_section_associations():
    """Return response from retrieving all staff section associations"""
    return _request("GET", "/v1/staffSectionAssociations")


def _get_staff_section_association(ref_id):
    """Return response from retrieving staff section association with ref_id"""
    return _request("GET", "/v1/staffSectionAssociations/%s" % ref_id)


def _get_staff_person_assignments():
    """Return response from retrieving all staff person assignments"""
    return _request("GET", "/v1/staffPersonAssignments")


def _get_staff_person_assignment(ref_id):
    """Return response from retrieving staff person assignment with ref_id"""
    return _request("GET", "/v1/staffPersonAssignments/%s" % ref_id)
    

def _get_student_section_associations():
    """Return response from retrieving all student section associations"""
    return _request("GET", "/v1/studentSectionAssociations")


def _get_student_section_association(ref_id):
    """Return response from retrieving student section association with
    ref_id"""
    return _request("GET", "/v1/studentSectionAssociations/%s" % ref_id)


def _get_student_school_associations():
    """Return response from retrieving all student school associations"""
    return _request("GET", "/v1/studentSchoolAssociations")


def _get_student_school_association(ref_id):
    """Return response from retrieving student school association with
    ref_id"""
    return _request("GET", "/v1/studentSchoolAssociations/%s" % ref_id)


def _get_staff_persons():
    """Return response from retrieving all staff persons"""
    return _request("GET", "/v1/staffPersons")


def _get_staff_person(ref_id):
    """Return response from retrieving staff person with ref_id"""
    return _request("GET", "/v1/staffPersons/%s" % ref_id)


def _get_organization_organization_associations():
    """Return response from retrieving all organization organization
    associations"""
    return _request("GET", "/v1/organizationOrganizationAssociations")


def _get_organization_organization_association(ref_id):
    """Return response from retrieving organization organization association
    with ref_id"""
    return _request("GET", "/v1/organizationOrganizationAssociations/%s"
                    % ref_id)


def _get_assignments():
    """Return response from retrieving all assignments"""
    return _request("GET", "/v1/assignments")


def _get_assignment(ref_id):
    """Return response from retrieving assignment with ref_id"""
    return _request("GET", "/v1/assignments/%s" % ref_id)


def _get_assignment_assignment_submissions(ref_id):
    """Return response from retrieving all assignment submissions for
    assignment with ref_id"""
    return _request("GET", "/v1/assignments/%s/assignmentSubmissions" % ref_id)


def _post_assignment(assignment):
    """Return response from posting an assignment"""
    return _request("POST", "/v1/assignments/", assignment)


def _update_assignment(ref_id, updates):
    """Return response from updating an assignment with ref_id"""
    return _request("PATCH", "/v1/assignments/%s" % ref_id, updates)


def _get_assignment_submissions():
    """Return response from retrieving all assignment submissions"""
    return _request("GET", "/v1/assignmentSubmissions")


def _get_assignment_submission(ref_id):
    """Return response from retrieving assignment submission with ref_id"""
    return _request("GET", "/v1/assignmentSubmissions/%s" % ref_id)


def _update_assignment_submission(ref_id, updates):
    """Return response from updating an assignment submission with ref_id"""
    return _request("PATCH", "/v1/assignments/%s" % ref_id, updates)


def _get_documents():
    """Return response from retrieving all documents"""
    return _request("GET", "/v1/documents")


def _get_document(ref_id):
    """Return response from retrieving document with ref_id"""
    return _request("GET", "/v1/documents/%s" % ref_id)


def _update_document(ref_id, document):
    """Return response from updating an document with ref_id"""
    return _request("PUT", "/v1/documents/%s" % ref_id, document)


def _post_document(document):
    """Return response from posting a document"""
    return _request("POST", "/v1/documents/", document)


def _delete_document(ref_id):
    """Return response from deleting a document"""
    return _request("DELETE", "/v1/documents/", ref_id)
    

def _get_tags():
    """Return response from retrieving all tags"""
    return _request("GET", "/v1/tags")


def _get_tag(ref_id):
    """Return response from retrieving tag with ref_id"""
    return _request("GET", "/v1/tags/%s" % ref_id)


def _update_tag(ref_id, tag):
    """Return response from updating a tag with ref_id"""
    return _request("PUT", "/v1/tags/%s" % ref_id, tag)


def _post_tag(tag):
    """Return response from posting a tag"""
    return _request("POST", "/v1/tags/", tag)


def _delete_tag(ref_id):
    """Return response from deleting a tag"""
    return _request("DELETE", "/v1/tags/", ref_id)


def _get_learning_content():
    """Return response from getting HMH learning content"""
    return _request("GET", "/v1/learning_content/")

    
class _HMHAuth(requests.auth.AuthBase):
    """Authentication for a request to the HMH server"""
    def __init__(self, api_key, sif_token=None):
        """Initialize the HMH authentication"""
        self.api_key = api_key
        self.sif_token = sif_token if sif_token else None

    def __call__(self, r):
        """Implement the HMH authentication for request r"""
        if self.sif_token:
            r.headers["Authorization"] = self.sif_token
        r.headers["Vnd-HMH-Api-key"] = self.api_key
        return r

'''
for staff in _get_staff_persons().json():
    print staff
print

for section in _get_sections().json():
    print section
print

for assignment in _get_assignments().json():
    print assignment

for assignment in _get_assignments().json():
    print assignment
'''